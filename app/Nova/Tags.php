<?php

namespace App\Nova;

use App\Models\CaseStudy as CaseStudyModel;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Tags extends Resource
{

  /**
   * The model the resource corresponds to.
   *
   * @var string
   */
  public static $model = \Spatie\Tags\Tag::class;

  /**
   * The visual style used for the table. Available options are 'tight' and 'default'.
   *
   * @var string
   */
  public static $tableStyle = 'tight';

  /**
   * The single value that should be used to represent the resource when being displayed.
   *
   * @var string
   */
  public static $title = 'name';

  /**
   * Disable sorting cache.
   * 
   * @var boolean
   */
  public static $sortableCacheEnabled = false;

  public static $trafficCop = false;
  /**
   * The columns that should be searched.
   *
   * @var array
   */
  public static $search = [
    'name', 'slug', 'type'
  ];

  public static function label()
  {
    return 'Címkék';
  }

  public static function singularLabel()
  {
    return 'Címke';
  }

  // /**
  //  * Return the location to redirect the user after creation.
  //  *
  //  * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
  //  * @param  \Laravel\Nova\Resource  $resource
  //  * @return \Laravel\Nova\URL|string
  //  */
  // public static function redirectAfterCreate(NovaRequest $request, $resource)
  // {
  //   return '/resources/' . static::uriKey();
  // }

  // /**
  //  * Return the location to redirect the user after update.
  //  *
  //  * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
  //  * @param  \Laravel\Nova\Resource  $resource
  //  * @return \Laravel\Nova\URL|string
  //  */
  // public static function redirectAfterUpdate(NovaRequest $request, $resource)
  // {
  //   return '/resources/' . static::uriKey();
  // }

  /**
   * Get the fields displayed by the resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function fields(Request $request)
  {
    $fields = [];

    foreach (config('site.available_locales') as $locale => $label)
    {
      $fields[] = new Panel('Címke '.$label['label'].' nyelven', [
        Text::make('Címke', "name->{$locale}")
          ->fillUsing(function ($request, $model, $attribute, $requestAttribute) use ($locale) {
            return $model->getTranslation($requestAttribute, $locale);
          })
          ->rules('required', 'max:255')
          ->hideFromDetail()
          ->hideFromIndex(),
        Slug::make('', "slug->{$locale}")
          ->fillUsing(function ($request, $model, $attribute, $requestAttribute) use ($locale) {
            return $model->getTranslation($requestAttribute, $locale);
          })
          ->from("name->{$locale}")
          ->hideFromDetail()
          ->hideFromIndex(),
      ]);
    }

    $fields[] = Text::make('Címke')
      ->resolveUsing(function () {
          $result = $this->resource->getTranslation('name', config('site.default_locale'));
          $more_t = [];
          foreach (config('site.available_locales') as $locale => $label)
          {
            if ($locale != config('site.default_locale'))
            {
              $more_t[] = $this->resource->getTranslation('name', $locale);
            }
          }
          if (!empty($more_t))
          {
            $result .= ' ('.implode(', ', $more_t).')';
          }

          return $result;
      })
      ->asHtml()
      ->hideWhenCreating()
      ->hideWhenUpdating();
    
    $fields[] = Select::make('Típus', 'type')->options([
      CaseStudyModel::TAG_TYPE => 'Case Study'
    ])->displayUsingLabels();

    return $fields;
  }
}

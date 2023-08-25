<?php

namespace App\Nova;


use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class Partner extends Resource
{
  /**
   * The model the resource corresponds to.
   *
   * @var string
   */
  public static $model = \App\Models\Partner::class;

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
    'name',
  ];

  public static function label()
  {
    return 'Ügyfelek';
  }

  public static function singularLabel()
  {
    return 'Ügyfél';
  }

  /**
   * Get the fields displayed by the resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function fields(Request $request)
  {
    $model = $this;

    $fields = [
      BelongsToMany::make(__('Site'), 'site', \App\Nova\Site::class)
        ->fields(function ($request, $relatedModel) {
          return [
            Text::make(__('Dependence type'), 'dependence_type')
              ->default(\Neon\Models\Menu::class)
              ->readonly()
              ->hideFromIndex(),
          ];
        }),
      Text::make('Név', 'name')
        ->rules('required', 'max:255'),
      Text::make('Link')
        ->rules('max:255'),
      Image::make('Logó', 'logo')
        ->store(function (Request $request, $model) {
          /**
           * @todo Handle favicon via media library
           */
          $model->addMediaFromRequest('logo')->toMediaCollection('partners');
        })
        ->preview(function () {
          return $this->getFirstMediaUrl('partners', 'thumb');
        })
        ->thumbnail(function () {
          return $this->getFirstMediaUrl('partners', 'thumb');
        })
    ];

    return $fields;
  }

  /**
   * Build an "index" query for the given resource.
   *
   * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public static function indexQuery(NovaRequest $request, $query)
  {
    $next = parent::indexQuery($request, $query);

    $next->withoutGlobalScopes([
      \Neon\Site\Models\Scopes\SiteScope::class
    ]);

    // dd($next);
    return $next;
  }
}

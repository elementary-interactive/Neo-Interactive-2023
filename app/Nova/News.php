<?php

namespace App\Nova;

use App\Models\CaseStudy as CaseStudyModel;
use App\Models\News as ModelsNews;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;

class News extends Resource
{
  /**
   * The model the resource corresponds to.
   *
   * @var string
   */
  public static $model = \App\Models\News::class;

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
  public static $title = 'title';

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
    'title', 'brief', 'solution', 'result'
  ];

  public static function label()
  {
    return 'Hírek';
  }

  public static function singularLabel()
  {
    return 'Hír';
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
    $fields = [
      BelongsTo::make('Weboldal', 'site', \App\Nova\Site::class),
      Text::make('Cím', 'title')
        ->rules('required', 'max:255'),
      Text::make('')
        ->resolveUsing(function () {
          return '<a style="color: inherit;" href="' . route($this->resource->site->locale . '.news.show', ['slug' => $this->resource->slug]) . '" target="_blank" title="' . $this->resource->title . '">' . view('nova::icon.svg-link', [
            'color'     => 'rgb(var(--colors-gray-400), 0.75)'
          ])->render() . '</a>';
        })
        ->asHtml()
        ->onlyOnIndex(),
      Slug::make('', 'slug')
        ->from('title')
        ->hideFromIndex(),
      // Images::make(__('Images'), ModelsNews::MEDIA_COLLECTION) // second parameter is the media collection name
      //   ->conversionOnPreview('responsive') // conversion used to display the "original" image
      //   ->conversionOnDetailView('responsive') // conversion used on the model's view
      //   ->conversionOnIndexView('responsive') // conversion used to display the image on the model's index page
      //   ->conversionOnForm('responsive') // conversion used to display the image on the model's form
      //   // validation rules for the collection of images
      //   ->singleImageRules('dimensions:min_width=100')
      //   ->withResponsiveImages()
      //   ->enableExistingMedia(),
      Image::make('Kép', 'image')
        ->store(function (Request $request, $model) {
          /**
           * @todo Handle favicon via media library
           */
          $media = $model->addMediaFromRequest('image')->toMediaCollection(\App\Models\News::MEDIA_COLLECTION);
          return $media->file_name;
        })
        ->preview(function () {
          return $this->getFirstMediaUrl(\App\Models\News::MEDIA_COLLECTION, 'thumb');
        })
        ->thumbnail(function () {
          return $this->getFirstMediaUrl(\App\Models\News::MEDIA_COLLECTION, 'thumb');
        }),
      Trix::make('Lead', 'lead')
        ->rules('required'),
      Trix::make('Tartalom', 'content')
        ->rules('required'),
      Tags::make('Címkék', 'tags')
        ->type(ModelsNews::TAG_TYPE),
      Heading::make('Elérhetőség'),
      Boolean::make('Aktív', 'status')
        ->trueValue(\Neon\Models\Statuses\BasicStatus::Active->value)
        ->falseValue(\Neon\Models\Statuses\BasicStatus::Inactive->value)
        ->help(__('Check this on if you want to link be available!')),
      DateTime::make(__('Published at'), 'published_at')
        ->help('Ettől az időponttól kezdődően jelenik meg az állásajánlat a honlapon.'),
      DateTime::make(__('Expired at'), 'expired_at')
        ->help('Nem kötelező kitölteni. Ha ki van töltve, ettől az időponttól kezdődően már nem látható az állásajánlat a honlapon.'),
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
    $next = parent::indexQuery($request, static::indexQuery($request, $query));

    $next->withoutGlobalScopes([
      \Neon\Models\Scopes\ActiveScope::class,
      \Neon\Models\Scopes\PublishedScope::class
    ]);

    // dd($next);
    return $next;
  }
}

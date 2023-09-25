<?php

namespace App\Nova;

use App\Nova\Actions\ModelChangeStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class Leader extends Resource
{
  use HasSortableRows {
    indexQuery as indexSortableQuery;
  }

  /**
   * The model the resource corresponds to.
   *
   * @var string
   */
  public static $model = \App\Models\Leader::class;

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
    'name', 'position', 'link_facebook', 'link_linkedin'
  ];

  public static function label()
  {
    return 'Munkatársaink';
  }

  public static function singularLabel()
  {
    return 'Munkatársunk';
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
      BelongsTo::make('Weboldal', 'site', \App\Nova\Site::class)
        ->filterable(),
      Text::make('Név', 'name')
        ->rules('required', 'max:255'),
      Text::make('Pozíció', 'position')
        ->rules('required', 'max:255'),
      Image::make('Kép', 'image')
        ->store(function (Request $request, $model) {
          //- Clean up first.
          $model->clearMediaCollection(\App\Models\Course::MEDIA_COLLECTION);
          
          $media = $model->addMediaFromRequest('image')->toMediaCollection(\App\Models\Leader::MEDIA_COLLECTION);
          return $media->file_name;
        })
        ->preview(function () {
          return $this->getFirstMediaUrl(\App\Models\Leader::MEDIA_COLLECTION, 'thumb');
        })
        ->thumbnail(function () {
          return $this->getFirstMediaUrl(\App\Models\Leader::MEDIA_COLLECTION, 'thumb');
        }),
      Boolean::make('Aktív', 'status')
        ->trueValue(\Neon\Models\Statuses\BasicStatus::Active->value)
        ->falseValue(\Neon\Models\Statuses\BasicStatus::Inactive->value),
      Boolean::make('Kezdőoldalra', 'show_on_main'),
      Text::make('Facebook link', 'link_facebook')
        ->rules('nullable', 'url', 'max:255')
        ->hideFromIndex(),
      Text::make('Linkedin link', 'link_linkedin')
        ->rules('nullable', 'url', 'max:255')
        ->hideFromIndex(),
    ];

    return $fields;
  }

  public function actions(NovaRequest $request)
  {
    return [
      new ModelChangeStatus,
    ];
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
    $next = parent::indexQuery($request, static::indexSortableQuery($request, $query));

    $next->withoutGlobalScopes([
      \Neon\Models\Scopes\ActiveScope::class
    ]);
    $next->orderBy('order', 'ASC');

    // dd($next);
    return $next;
  }
}

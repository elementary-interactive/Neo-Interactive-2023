<?php

namespace App\Nova;

use App\Nova\Actions\ModelHideOnMain;
use App\Nova\Actions\ModelShowOnMain;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class Partner extends Resource
{
  use HasSortableRows {
    indexQuery as indexSortableQuery;
  }

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
    'name', 'link'
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
   * Return the location to redirect the user after creation.
   *
   * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
   * @param  \Laravel\Nova\Resource  $resource
   * @return \Laravel\Nova\URL|string
   */
  public static function redirectAfterCreate(NovaRequest $request, $resource)
  {
    return '/resources/' . static::uriKey();
  }

  /**
   * Return the location to redirect the user after update.
   *
   * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
   * @param  \Laravel\Nova\Resource  $resource
   * @return \Laravel\Nova\URL|string
   */
  public static function redirectAfterUpdate(NovaRequest $request, $resource)
  {
    return '/resources/' . static::uriKey();
  }

  /**
   * Get the fields displayed by the resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function fields(Request $request)
  {
    $fields = [
      // BelongsToMany::make(__('Site'), 'site', \App\Nova\Site::class)
      //   ->fields(function ($request, $relatedModel) {
      //     return [
      //       Text::make(__('Dependence type'), 'dependence_type')
      //         ->default(\Neon\Models\Menu::class)
      //         ->readonly()
      //         ->hideFromIndex(),
      //     ];
      //   }),
      Text::make('Név', 'name')
        ->rules('required', 'max:255'),
      Slug::make('', 'slug')
        ->from('name')
        ->hideFromIndex(),
      Text::make('Link')
        ->rules('nullable', 'url', 'max:255')
        ->displayUsing(function ($value) {
          return Str::limit($value, 32) . '...';
        }),
      Image::make('Logó', 'logo')
        ->store(function (Request $request, $model) {
          //- Clean up first.
          $model->clearMediaCollection('partners');
          
          $media = $model->addMediaFromRequest('logo')->toMediaCollection('partners');

          return $media->file_name;
        })
        ->preview(function () {
          return $this->getFirstMediaUrl('partners', 'thumb');
        })
        ->thumbnail(function () {
          return $this->getFirstMediaUrl('partners', 'thumb');
        }),
      Boolean::make('Kezdőoldalra', 'show_on_main'),
    ];

    return $fields;
  }

  public function actions(NovaRequest $request)
  {
    return [
      new ModelShowOnMain(),
      new ModelHideOnMain()
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

    // $next->withoutGlobalScopes([
    //   \Neon\Site\Models\Scopes\SiteScope::class
    // ]);
    $next->orderBy('order', 'ASC');

    // dd($next);
    return $next;
  }
}

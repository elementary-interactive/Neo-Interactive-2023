<?php

namespace App\Nova;

use App\Models\Book as BookModel;
use App\Nova\Actions\ModelHideOnMain;
use App\Nova\Actions\ModelShowOnMain;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use ClassicO\NovaMediaLibrary\NovaMediaLibrary;
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
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Murdercode\TinymceEditor\TinymceEditor;
use Spatie\TagsField\Tags;

class Book extends Resource
{
  /**
   * The model the resource corresponds to.
   *
   * @var string
   */
  public static $model = \App\Models\Book::class;

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
    'title', 'content'
  ];

  public static function label()
  {
    return 'DMTK 2023';
  }

  public static function singularLabel()
  {
    return 'DMTK 2023';
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
      // BelongsTo::make('Weboldal', 'site', \App\Nova\Site::class)
      //   ->nullable(),
      // BelongsTo::make('Partner', 'partner', \App\Nova\Partner::class)
      // ->showCreateRelationButton(),
      Text::make('Cím', 'title')
        ->rules('required', 'max:255'),
      Text::make('')
        ->resolveUsing(function () {
          return '<a style="color: inherit;" href="' . route('hu.book.show', ['slug' => $this->resource->slug]) . '" target="_blank" title="' . $this->resource->title . '">' . view('nova::icon.svg-link', [
            'color'     => 'rgb(var(--colors-gray-400), 0.75)'
          ])->render() . '</a>';
        })
        ->asHtml()
        ->onlyOnIndex(),
      Slug::make('', 'slug')
        ->from('title')
        ->hideFromIndex(),
      Select::make('Csoport', 'group')
        ->resolveUsing(function () {
          return $this->resource->groupKey;
        })
        ->options(BookModel::$groups)
        ->displayUsingLabels()
        ->hideFromDetail()
        ->hideFromIndex(),
      Text::make('Csoport', '')
        ->resolveUsing(function () {
          return $this->resource->group->label;
        })
        ->showOnDetail()
        ->showOnIndex()
        ->hideWhenCreating()
        ->hideWhenUpdating(),
      Images::make(__('Images'), BookModel::MEDIA_COLLECTION) // second parameter is the media collection name
        ->conversionOnPreview('responsive') // conversion used to display the "original" image
        ->conversionOnDetailView('responsive') // conversion used on the model's view
        ->conversionOnIndexView('responsive') // conversion used to display the image on the model's index page
        ->conversionOnForm('responsive') // conversion used to display the image on the model's form
        // validation rules for the collection of images
        ->singleImageRules('dimensions:min_width=100')
        ->withResponsiveImages()
        ->enableExistingMedia(),
      Trix::make('Tartalom', 'content')
        ->rules(['required', 'min:20'])
        ->withFiles()
        ->help(__('The content of the article.')),

      //   ->withMeta(['mediaLibrary' => true]),
      // MediaLibrary::make('Insert image', 'js_callback_media_library')
      //   ->jsCallback('mediaLibrarySelectFiles', ['editor' => 'body'])->types(['Image']),
      // ->readonly(),
      // Trix::make('Brief', 'brief'),
      // Trix::make('Megoldás', 'solution'),
      // Trix::make('Eredmény', 'result'),
      // Boolean::make('Kezdőoldalra', 'show_on_main'),
      // Tags::make('Címkék', 'tags')
      //   ->type(BookModel::TAG_TYPE),
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

  // /**
  //  * Build an "index" query for the given resource.
  //  *
  //  * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
  //  * @param  \Illuminate\Database\Eloquent\Builder  $query
  //  * @return \Illuminate\Database\Eloquent\Builder
  //  */
  // public static function indexQuery(NovaRequest $request, $query)
  // {
  //   // $next = parent::indexQuery($request, static::indexSortableQuery($request, $query));
  //   $next = parent::indexQuery($request, static::indexQuery($request, $query));

  //   // $next->withoutGlobalScopes([
  //   //   \Neon\Site\Models\Scopes\SiteScope::class
  //   // ]);
  //   $next->orderBy('create', 'ASC');

  //   // dd($next);
  //   return $next;
  // }
}

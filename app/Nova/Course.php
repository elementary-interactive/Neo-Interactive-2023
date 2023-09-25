<?php

namespace App\Nova;

use App\Nova\Actions\ModelChangeStatus;
use App\Nova\CourseParticipant;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class Course extends Resource
{
  use HasSortableRows {
    indexQuery as indexSortableQuery;
  }

  /**
   * The model the resource corresponds to.
   *
   * @var string
   */
  public static $model = \App\Models\Course::class;

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
    'title', 'description'
  ];

  public static function label()
  {
    return 'Kurzusok';
  }

  public static function singularLabel()
  {
    return 'Kurzus';
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
      BelongsTo::make('Weboldal', 'site', \App\Nova\Site::class)
        ->filterable(),
      Text::make('Előadás címe', 'title')
        ->rules('required', 'max:255'),
      Slug::make("", 'slug')
        ->from('title'),
      Trix::make('Leírás', 'description')
        ->rules('required'),
      Code::make('Videó beágyazása', 'embed')
        ->help('A stream videó - például Youtube - "embed" kódja illesztendő ide.'),
      Image::make('Kép', 'image')
        ->store(function (Request $request, $model) {
          //- Clean up first.
          $model->clearMediaCollection(\App\Models\Course::MEDIA_COLLECTION);
          
          $media = $model->addMediaFromRequest('image')->toMediaCollection(\App\Models\Course::MEDIA_COLLECTION);
          return $media->file_name;
        })
        ->preview(function () {
          return $this->getFirstMediaUrl(\App\Models\Course::MEDIA_COLLECTION, 'thumb');
        })
        ->thumbnail(function () {
          return $this->getFirstMediaUrl(\App\Models\Course::MEDIA_COLLECTION, 'thumb');
        }),
      Heading::make('Elérhetőség'),
      Boolean::make('Regisztráció nyitva', 'registration_open'),
      Boolean::make('Aktív', 'status')
        ->trueValue(\Neon\Models\Statuses\BasicStatus::Active->value)
        ->falseValue(\Neon\Models\Statuses\BasicStatus::Inactive->value)
        ->help(__('Check this on if you want to link be available!')),
      DateTime::make("Kurzus kezdete", 'start_at'),
      DateTime::make(__('Published at'), 'published_at')
        ->help('Ettől az időponttól kezdődően jelenik meg az állásajánlat a honlapon.'),
      DateTime::make(__('Expired at'), 'expired_at')
        ->help('Nem kötelező kitölteni. Ha ki van töltve, ettől az időponttól kezdődően már nem látható az állásajánlat a honlapon.'),
      HasMany::make('Résztvevők', 'participants', CourseParticipant::class),
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

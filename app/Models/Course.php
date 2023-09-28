<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Neon\Models\Traits\Statusable;
use Neon\Models\Traits\Publishable;
use Neon\Models\Traits\Uuid;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Course extends Model implements HasMedia, Sortable
{
  use HasFactory;
  use InteractsWithMedia;
  use SoftDeletes; // Laravel built in soft delete handler trait.
  use SortableTrait;
  use Statusable;
  use Uuid;

  const MEDIA_COLLECTION = 'courses';

  public $sortable = [
    'order_column_name'   => 'order',
    'sort_when_creating'  => true,
    'nova_order_by'       => 'ASC',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'slug', 'description'
  ];

  /** Cast attribute to array...
   * @var array
   */
  protected $casts = [
    'start_at'      => 'datetime',
    'created_at'    => 'datetime',
    'updated_at'    => 'datetime',
    'deleted_at'    => 'datetime',
    'published_at'  => 'datetime',
    'expired_at'    => 'datetime'
  ];

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection(self::MEDIA_COLLECTION); //->singleFile();
  }

  public function registerMediaConversions(?Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->height(300)
      ->width(300)
      ->preservingOriginal()
      ->performOnCollections(self::MEDIA_COLLECTION)
      ->nonQueued();

    $this->addMediaConversion('responsive')
      ->withResponsiveImages()
      ->preservingOriginal()
      ->performOnCollections(self::MEDIA_COLLECTION)
      ->nonQueued();
  }

  public function setDescriptionAttribute($value)
  {
    $this->attributes['description'] = str_replace('h1>', 'h2>', $value);
  }


  public function site(): BelongsTo
  {
    return $this->belongsTo(\Neon\Site\Models\Site::class);
  }

  public function participants(): HasMany
  {
    return $this->hasMany(CourseParticipant::class);
  }

  public function buildSortQuery()
  {
    return static::query()
      ->where('site_id', $this->site_id);
  }
}

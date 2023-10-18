<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Neon\Models\Traits\Uuid;
use Neon\Site\Models\Traits\SiteDependencies;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Book extends Model implements HasMedia, Sortable
{
  use HasFactory;
  // use SiteDependencies;
  use SoftDeletes; // Laravel built in soft delete handler trait.
  use SortableTrait;
  use Uuid;
  use InteractsWithMedia;

  const MEDIA_COLLECTION = 'books';

  public $sortable = [
    'order_column_name'   => 'order',
    'sort_when_creating'  => true,
    'nova_order_by'       => 'DESC',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'slug', 'content'
  ];

  /** Cast attribute to array...
   * @var array
   */
  protected $casts = [
    'created_at'    => 'timestamp',
    'updated_at'    => 'timestamp',
    'deleted_at'    => 'timestamp',
  ];

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection(self::MEDIA_COLLECTION); //->singleFile();
  }

  public function registerMediaConversions(?Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->height(680)
      ->performOnCollections(self::MEDIA_COLLECTION)
      ->nonQueued();

    $this->addMediaConversion('responsive')
      ->withResponsiveImages()
      ->performOnCollections(self::MEDIA_COLLECTION)
      ->nonQueued();
  }

  // public function partner(): BelongsTo
  // {
  //   return $this->belongsTo(Partner::class);
  // }

  // public function site(): BelongsTo
  // {
  //   return $this->belongsTo(\Neon\Site\Models\Site::class);
  // }

  public function buildSortQuery()
  {
    return static::query()->where('site_id', $this->site_id);
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Neon\Models\Traits\Uuid;;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait; 
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

use Neon\Models\Traits\Statusable;

class Leader extends Model implements HasMedia, Sortable
{
  use HasFactory;
  use InteractsWithMedia;
  use SoftDeletes; // Laravel built in soft delete handler trait.
  use SortableTrait;
  use Statusable;
  use Uuid;

  const MEDIA_COLLECTION = 'leaders';

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
    'name', 'position', 'image', 'link_facebook', 'link_linkedin', 'status', 'show_on_main'
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
    $this->addMediaCollection(self::MEDIA_COLLECTION);//->singleFile();
  }

  public function registerMediaConversions(?Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->height(300)
      ->width(300)
      ->performOnCollections(self::MEDIA_COLLECTION)
      ->nonQueued();
  }

  public function site(): BelongsTo
  {
    return $this->belongsTo(\Neon\Site\Models\Site::class);
  }

  public function buildSortQuery()
  {
    return static::query()->where('site_id', $this->site_id);
  }

}

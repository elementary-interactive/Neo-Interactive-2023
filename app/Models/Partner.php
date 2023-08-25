<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Neon\Models\Traits\Uuid;
use Neon\Site\Models\Traits\SiteDependencies;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Partner extends Model implements HasMedia
{
  use HasFactory;
  use SiteDependencies;
  use SoftDeletes; // Laravel built in soft delete handler trait.
  use Uuid;
  use InteractsWithMedia;

  const MEDIA_COLLECTION = 'partners';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'link', 'logo'
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
    $this->addMediaCollection(self::MEDIA_COLLECTION)->singleFile();
  }

  public function registerMediaConversions(?Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->setManipulations(['h' => 100, 'w' => 100, 'fm' => 'png', 'fit' => 'max'])
      ->performOnCollections(self::MEDIA_COLLECTION)
      ->nonQueued();
  }

}

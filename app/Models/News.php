<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Neon\Models\Traits\Uuid;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class News extends Model implements HasMedia
{
    use HasFactory;
    use HasTags;
    // use SiteDependencies;
    use SoftDeletes; // Laravel built in soft delete handler trait.
    use SortableTrait;
    use Uuid;
    use InteractsWithMedia;


    const MEDIA_COLLECTION = 'news';

    const TAG_TYPE = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'lead', 'content', 'status', 'published_at', 'expired_at'
    ];

    /** Cast attribute to array...
     * @var array
     */
    protected $casts = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
        'published_at'  => 'datetime',
        'expired_at'    => 'datetime',
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

    public function site(): BelongsTo
    {
        return $this->belongsTo(\Neon\Site\Models\Site::class);
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}

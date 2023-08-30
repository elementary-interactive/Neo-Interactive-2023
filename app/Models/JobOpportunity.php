<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Neon\Models\Traits\Statusable;
use Neon\Models\Traits\Publishable;
use Neon\Models\Traits\Uuid;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class JobOpportunity extends Model implements Sortable
{
  use HasFactory;
  use SoftDeletes; // Laravel built in soft delete handler trait.
  use SortableTrait;
  use Statusable;
  use Publishable;
  use Uuid;

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
    'created_at'    => 'datetime',
    'updated_at'    => 'datetime',
    'deleted_at'    => 'datetime',
    'published_at'  => 'datetime',
    'expired_at'    => 'datetime'
  ];

  public function site(): BelongsTo
  {
    return $this->belongsTo(\Neon\Site\Models\Site::class);
  }

  public function buildSortQuery()
  {
    return static::query()
        ->where('site_id', $this->site_id);
  }
}

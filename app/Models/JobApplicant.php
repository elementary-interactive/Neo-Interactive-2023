<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Neon\Models\Traits\Uuid;

class JobApplicant extends Model
{
    use HasFactory;
    use SoftDeletes; // Laravel built in soft delete handler trait.
    use Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'file'
    ];

    /** Cast attribute to array...
     * @var array
     */
    protected $casts = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function jobOpportunity(): BelongsTo
    {
        return $this->belongsTo(JobOpportunity::class);
    }
}

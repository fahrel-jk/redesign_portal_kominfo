<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_category_id',
        'name',
        'slug',
        'description',
        'access_type',
        'url',
        'path',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['public_url'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    /**
     * Compute public URL dynamically based on access_type (domain vs path).
     */
    public function getPublicUrlAttribute(): string
    {
        if ($this->access_type === 'path') {
            if (!$this->path) {
                return url('/');
            }
            return Str::startsWith($this->path, 'http') ? $this->path : url($this->path);
        }

        return $this->url ?: '#';
    }
}

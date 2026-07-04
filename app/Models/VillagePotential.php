<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class VillagePotential extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'summary',
        'description',
        'location',
        'image_base64',
        'image_mime_type',
        'image_alt',
        'gallery',
        'is_featured',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}

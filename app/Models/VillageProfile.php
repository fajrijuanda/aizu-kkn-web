<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    protected $fillable = [
        'name',
        'tagline',
        'district',
        'regency',
        'province',
        'postal_code',
        'area',
        'head_name',
        'head_greeting',
        'history',
        'vision',
        'missions',
        'address',
        'phone',
        'email',
        'hero_image_base64',
        'hero_image_mime_type',
        'hero_image_alt',
        'logo_base64',
        'logo_mime_type',
        'map_embed_url',
        'social_links',
    ];

    protected function casts(): array
    {
        return [
            'missions' => 'array',
            'social_links' => 'array',
        ];
    }
}

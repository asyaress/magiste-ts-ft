<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\BlogPost;


class BlogSection extends Model
{
    protected $fillable = [
        'slug',
        'subtitle',
        'title',
        'button_text',
        'button_url',
        'is_active',
        'sort_order'
    ];

    public function posts(): HasMany
    {
        // Tampilkan hanya yang publish di FE
        return $this->hasMany(BlogPost::class)
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderBy('sort_order');
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }
}

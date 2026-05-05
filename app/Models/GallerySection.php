<?php

namespace App\Models;

use App\Models\GalleryItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GallerySection extends Model
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

    public function items(): HasMany
    {
        return $this->hasMany(GalleryItem::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }
}

<?php

namespace App\Models;

use App\Models\Concerns\ResolvesMediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VideoGallerySection extends Model
{
    use ResolvesMediaUrl;

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'background_image_path',
        'background_image_alt',
        'is_active',
        'sort_order',
    ];

    protected $appends = ['background_image_url'];

    public function items(): HasMany
    {
        return $this->hasMany(VideoGalleryItem::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function getBackgroundImageUrlAttribute(): ?string
    {
        return $this->resolveMediaUrl($this->background_image_path);
    }
}

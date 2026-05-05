<?php

namespace App\Models;

use App\Models\Concerns\ResolvesMediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchTopic extends Model
{
    use ResolvesMediaUrl;

    protected $fillable = [
        'research_section_id',
        'title',
        'slug',
        'description',
        'icon_class',
        'bg_color_class',
        'image_path',
        'image_alt',
        'gallery_image_path',
        'animation_delay_ms',
        'is_active',
        'sort_order'
    ];

    protected $appends = ['image_url', 'gallery_image_url'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(ResearchSection::class, 'research_section_id');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->image_path, 'assets/images/placeholder.jpg');
    }

    public function getGalleryImageUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->gallery_image_path ?: $this->image_path, 'assets/images/placeholder.jpg');
    }
}

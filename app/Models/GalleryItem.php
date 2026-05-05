<?php

namespace App\Models;

use App\Models\Concerns\ResolvesMediaUrl;
use App\Models\GallerySection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryItem extends Model
{
    use ResolvesMediaUrl;

    protected $fillable = [
        'gallery_section_id',
        'title',
        'slug',
        'category_label',
        'icon_class',
        'icon_color_class',
        'image_path',
        'image_alt',
        'overlay_link_path',
        'col_classes',
        'is_active',
        'sort_order'
    ];

    protected $appends = ['image_url', 'overlay_url'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(GallerySection::class, 'gallery_section_id');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->image_path, 'assets/images/placeholder.jpg');
    }

    public function getOverlayUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->overlay_link_path ?: $this->image_path, 'assets/images/placeholder.jpg');
    }
}

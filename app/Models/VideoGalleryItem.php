<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoGalleryItem extends Model
{
    protected $fillable = [
        'video_gallery_section_id',
        'title',
        'video_url',
        'play_icon_class',
        'animation_delay_ms',
        'is_active',
        'sort_order'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(VideoGallerySection::class, 'video_gallery_section_id');
    }
}

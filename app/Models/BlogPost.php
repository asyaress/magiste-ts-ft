<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Concerns\ResolvesMediaUrl;
use App\Models\BlogSection;


class BlogPost extends Model
{
    use ResolvesMediaUrl;

    protected $fillable = [
        'blog_section_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'image_path',
        'image_alt',
        'overlay_icon_class',
        'author_name',
        'comment_count',
        'published_at',
        'is_published',
        'animation_duration_ms',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(BlogSection::class, 'blog_section_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->resolveMediaUrl($this->image_path);
    }

    public function scopePublished($q)
    {
        return $q->where('is_published', true)->whereNotNull('published_at');
    }
}

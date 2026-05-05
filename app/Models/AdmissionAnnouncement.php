<?php

namespace App\Models;

use App\Models\Concerns\ResolvesMediaUrl;
use Illuminate\Database\Eloquent\Model;

class AdmissionAnnouncement extends Model
{
    use ResolvesMediaUrl;

    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'image_alt',
        'button_text',
        'button_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->resolveMediaUrl($this->image_path);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}


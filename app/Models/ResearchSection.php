<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResearchSection extends Model
{
    protected $fillable = [
        'slug',
        'subtitle',
        'title',
        'button_text',
        'button_url',
        'is_active',
        'sort_order',
    ];

    public function topics(): HasMany
    {
        return $this->hasMany(ResearchTopic::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    // scope ringan
    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }
}

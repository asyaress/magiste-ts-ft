<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeMissionItem extends Model
{
    protected $fillable = [
        'icon_class',
        'title',
        'description',
        'animation_class',
        'animation_delay_ms',
        'sort_order',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

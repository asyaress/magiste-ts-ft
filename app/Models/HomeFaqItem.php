<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFaqItem extends Model
{
    protected $fillable = [
        'step_number',
        'title',
        'content_html',
        'is_open_by_default',
        'sort_order',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

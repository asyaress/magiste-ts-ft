<?php

namespace App\Models;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeacherSection extends Model
{
    protected $fillable = ['slug', 'subtitle', 'title', 'is_active', 'sort_order'];

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }
}

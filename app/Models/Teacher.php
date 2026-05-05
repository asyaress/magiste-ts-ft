<?php

namespace App\Models;

use App\Models\Concerns\ResolvesMediaUrl;
use App\Models\TeacherSection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use ResolvesMediaUrl;

    protected $fillable = [
        'teacher_section_id',
        'name',
        'slug',
        'tagline',
        'photo_path',
        'photo_alt',
        'profile_url',
        'linkedin_url',
        'scholar_url',
        'website_url',
        'col_classes',
        'wow_animation_class',
        'animation_delay_ms',
        'animation_duration_ms',
        'is_active',
        'sort_order'
    ];

    protected $appends = ['photo_url'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(TeacherSection::class, 'teacher_section_id');
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->resolveMediaUrl($this->photo_path);
    }
}

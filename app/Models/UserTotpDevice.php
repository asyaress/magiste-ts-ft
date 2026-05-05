<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTotpDevice extends Model
{
    protected $fillable = [
        'user_id',
        'device_name',
        'secret',
        'last_used_at',
    ];

    protected $hidden = [
        'secret',
    ];

    protected $casts = [
        'secret' => 'encrypted',
        'last_used_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}


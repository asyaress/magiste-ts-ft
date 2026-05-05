<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function allAsMap(): array
    {
        return Cache::remember('site:settings', 3600, function () {
            return static::query()->pluck('value', 'key')->toArray();
        });
    }

    public static function getValue(string $key, ?string $default = null): ?string
    {
        $settings = static::allAsMap();
        return $settings[$key] ?? $default;
    }

    public static function setValue(string $key, ?string $value): void
    {
        static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
    }
}

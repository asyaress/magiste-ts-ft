<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait ResolvesMediaUrl
{
    protected function resolveMediaUrl(?string $path, ?string $fallback = null): ?string
    {
        $candidate = trim((string) ($path ?: $fallback ?: ''));
        if ($candidate === '') {
            return null;
        }

        $candidate = str_replace('\\', '/', $candidate);

        if (Str::startsWith($candidate, ['http://localhost', 'https://localhost', 'http://127.0.0.1', 'https://127.0.0.1'])) {
            $parsedPath = parse_url($candidate, PHP_URL_PATH);
            if (is_string($parsedPath) && $parsedPath !== '') {
                $candidate = ltrim($parsedPath, '/');
            }
        }

        if (Str::startsWith($candidate, ['http://', 'https://'])) {
            return $candidate;
        }

        if (Str::startsWith($candidate, '/')) {
            return url($candidate);
        }

        return asset(ltrim($candidate, '/'));
    }
}


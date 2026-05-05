<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminTwoFactor
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('admin.login');
        }

        if ($request->session()->get('admin_2fa_passed') === true) {
            return $next($request);
        }

        $hasDevice = $user->totpDevices()->exists();

        if (!$hasDevice) {
            return redirect()->route('admin.2fa.setup');
        }

        return redirect()->route('admin.2fa.challenge');
    }
}


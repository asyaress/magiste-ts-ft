<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserTotpDevice;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function index(Request $request)
    {
        $devices = $request->user()
            ->totpDevices()
            ->orderByDesc('last_used_at')
            ->orderBy('device_name')
            ->get();

        return view('admin.security.index', compact('devices'));
    }

    public function destroyDevice(Request $request, UserTotpDevice $device)
    {
        $user = $request->user();

        if ((int) $device->user_id !== (int) $user->id) {
            abort(403);
        }

        if ($user->totpDevices()->count() <= 1) {
            return back()->withErrors([
                'security' => 'Minimal harus ada 1 perangkat authenticator aktif.',
            ]);
        }

        $device->delete();

        return back()->with('success', 'Perangkat authenticator berhasil dihapus.');
    }
}


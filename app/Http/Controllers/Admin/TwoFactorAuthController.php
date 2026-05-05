<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\TotpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TwoFactorAuthController extends Controller
{
    public function showSetup(Request $request, TotpService $totp)
    {
        $user = $request->user();
        $isInitialSetup = !$user->totpDevices()->exists();
        $isTwoFactorPassed = $request->session()->get('admin_2fa_passed') === true;

        if (!$isInitialSetup && !$isTwoFactorPassed) {
            return redirect()->route('admin.2fa.challenge');
        }

        if ($request->boolean('refresh')) {
            $request->session()->forget('admin_2fa_pending_secret');
        }

        $secret = $request->session()->get('admin_2fa_pending_secret');
        if (!$secret) {
            $secret = $totp->generateSecret();
            $request->session()->put('admin_2fa_pending_secret', $secret);
        }

        $issuer = (string) config('app.name', 'Admin TSFT');
        $accountName = (string) ($user->email ?: $user->name);
        $otpAuthUri = $totp->makeOtpAuthUri($issuer, $accountName, $secret);
        $qrCodeSvg = QrCode::format('svg')
            ->size(260)
            ->margin(1)
            ->generate($otpAuthUri);

        return view('admin.auth.two-factor-setup', compact(
            'secret',
            'issuer',
            'accountName',
            'otpAuthUri',
            'qrCodeSvg',
            'isInitialSetup'
        ));
    }

    public function storeSetup(Request $request, TotpService $totp)
    {
        $user = $request->user();
        $isInitialSetup = !$user->totpDevices()->exists();

        $data = $request->validate([
            'device_name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'digits:6'],
        ]);

        $secret = (string) $request->session()->get('admin_2fa_pending_secret');
        if ($secret === '') {
            return redirect()->route('admin.2fa.setup')
                ->withErrors(['code' => 'Sesi setup sudah habis. Silakan scan QR ulang.']);
        }

        if (!$totp->verifyCode($secret, $data['code'])) {
            return back()
                ->withErrors(['code' => 'Kode authenticator tidak valid.'])
                ->withInput($request->only('device_name'));
        }

        $user->totpDevices()->create([
            'device_name' => $data['device_name'],
            'secret' => $secret,
            'last_used_at' => now(),
        ]);

        $request->session()->forget('admin_2fa_pending_secret');

        if ($isInitialSetup) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')
                ->with('success', 'Setup Google Authenticator berhasil. Silakan login kembali dan masukkan kode authenticator.');
        }

        return redirect()->route('admin.security.index')
            ->with('success', 'Perangkat authenticator berhasil ditambahkan.');
    }

    public function showChallenge(Request $request)
    {
        $user = $request->user();

        if (!$user->totpDevices()->exists()) {
            return redirect()->route('admin.2fa.setup');
        }

        if ($request->session()->get('admin_2fa_passed') === true) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.two-factor-challenge');
    }

    public function verifyChallenge(Request $request, TotpService $totp)
    {
        $data = $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = $request->user();
        $matchedDevice = null;

        foreach ($user->totpDevices()->get() as $device) {
            if ($totp->verifyCode($device->secret, $data['code'])) {
                $matchedDevice = $device;
                break;
            }
        }

        if (!$matchedDevice) {
            return back()->withErrors(['code' => 'Kode authenticator tidak valid.']);
        }

        $matchedDevice->forceFill([
            'last_used_at' => now(),
        ])->save();

        $request->session()->put('admin_2fa_passed', true);

        return redirect()->intended(route('admin.dashboard'));
    }
}

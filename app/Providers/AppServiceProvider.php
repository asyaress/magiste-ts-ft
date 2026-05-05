<?php

namespace App\Providers;

use App\Models\AdmissionAnnouncement;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $settings = [];

            try {
                if (Schema::hasTable('site_settings')) {
                    $settings = SiteSetting::allAsMap();
                }
            } catch (\Throwable $e) {
                $settings = [];
            }

            $activeAdmissionAnnouncement = null;
            try {
                if (Schema::hasTable('admission_announcements')) {
                    $activeAdmissionAnnouncement = Cache::remember('homepage:active-admission-announcement', 300, function () {
                        return AdmissionAnnouncement::query()
                            ->active()
                            ->orderBy('sort_order')
                            ->orderByDesc('id')
                            ->first();
                    });
                }
            } catch (\Throwable $e) {
                $activeAdmissionAnnouncement = null;
            }

            $view->with('siteSettings', $settings);
            $view->with('kontak_wa', $settings['contact_whatsapp'] ?? null);
            $view->with('email_prodi', $settings['contact_email'] ?? null);
            $view->with('facebook', $settings['social_facebook'] ?? null);
            $view->with('twitter', $settings['social_twitter'] ?? null);
            $view->with('linkedin', $settings['social_linkedin'] ?? null);
            $view->with('instagram', $settings['social_instagram'] ?? null);
            $view->with('activeAdmissionAnnouncement', $activeAdmissionAnnouncement);
        });
    }
}

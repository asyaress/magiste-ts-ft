<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
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

            $view->with('siteSettings', $settings);
            $view->with('kontak_wa', $settings['contact_whatsapp'] ?? null);
            $view->with('email_prodi', $settings['contact_email'] ?? null);
            $view->with('facebook', $settings['social_facebook'] ?? null);
            $view->with('twitter', $settings['social_twitter'] ?? null);
            $view->with('linkedin', $settings['social_linkedin'] ?? null);
            $view->with('instagram', $settings['social_instagram'] ?? null);
        });
    }
}

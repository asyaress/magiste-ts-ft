<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SiteSettingController extends Controller
{
    private const KEYS = [
        'contact_whatsapp',
        'contact_email',
        'contact_link_url',
        'header_location_label',
        'header_location_text',
        'header_cta_text',

        'social_facebook',
        'social_twitter',
        'social_linkedin',
        'social_instagram',

        'footer_about_text',
        'footer_contact_title',
        'footer_contact_address_html',
        'footer_contact_note',

        'service_section_subtitle',
        'service_section_title_line1',
        'service_section_title_line2',
        'service_section_vision_text',
        'service_section_mission_intro',

        'about_section_subtitle',
        'about_section_title_line1',
        'about_section_title_line2',
        'about_section_headline',
        'about_stat_1_value',
        'about_stat_1_label',
        'about_stat_2_value',
        'about_stat_2_label',
        'about_stat_3_value',
        'about_stat_3_label',
        'about_image_path',
        'about_image_alt',

        'faq_section_subtitle',
        'faq_section_title_line1',
        'faq_section_title_line2',
        'faq_image_path',
        'faq_image_alt',
    ];

    public function index()
    {
        $settings = SiteSetting::allAsMap();
        return view('admin.site-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'contact_whatsapp' => ['nullable', 'string', 'max:50'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_link_url' => ['nullable', 'url', 'max:2048'],
            'header_location_label' => ['nullable', 'string', 'max:255'],
            'header_location_text' => ['nullable', 'string'],
            'header_cta_text' => ['nullable', 'string', 'max:255'],

            'social_facebook' => ['nullable', 'url', 'max:2048'],
            'social_twitter' => ['nullable', 'url', 'max:2048'],
            'social_linkedin' => ['nullable', 'url', 'max:2048'],
            'social_instagram' => ['nullable', 'url', 'max:2048'],

            'footer_about_text' => ['nullable', 'string'],
            'footer_contact_title' => ['nullable', 'string', 'max:255'],
            'footer_contact_address_html' => ['nullable', 'string'],
            'footer_contact_note' => ['nullable', 'string'],

            'service_section_subtitle' => ['nullable', 'string', 'max:255'],
            'service_section_title_line1' => ['nullable', 'string', 'max:255'],
            'service_section_title_line2' => ['nullable', 'string', 'max:255'],
            'service_section_vision_text' => ['nullable', 'string'],
            'service_section_mission_intro' => ['nullable', 'string'],

            'about_section_subtitle' => ['nullable', 'string', 'max:255'],
            'about_section_title_line1' => ['nullable', 'string', 'max:255'],
            'about_section_title_line2' => ['nullable', 'string', 'max:255'],
            'about_section_headline' => ['nullable', 'string'],
            'about_stat_1_value' => ['nullable', 'string', 'max:50'],
            'about_stat_1_label' => ['nullable', 'string', 'max:255'],
            'about_stat_2_value' => ['nullable', 'string', 'max:50'],
            'about_stat_2_label' => ['nullable', 'string', 'max:255'],
            'about_stat_3_value' => ['nullable', 'string', 'max:50'],
            'about_stat_3_label' => ['nullable', 'string', 'max:255'],
            'about_image_path' => ['nullable', 'string', 'max:2048'],
            'about_image_alt' => ['nullable', 'string', 'max:255'],

            'faq_section_subtitle' => ['nullable', 'string', 'max:255'],
            'faq_section_title_line1' => ['nullable', 'string', 'max:255'],
            'faq_section_title_line2' => ['nullable', 'string', 'max:255'],
            'faq_image_path' => ['nullable', 'string', 'max:2048'],
            'faq_image_alt' => ['nullable', 'string', 'max:255'],
        ]);

        foreach (self::KEYS as $key) {
            SiteSetting::setValue($key, $data[$key] ?? null);
        }

        Cache::forget('site:settings');

        return back()->with('success', 'Pengaturan situs berhasil diperbarui.');
    }
}

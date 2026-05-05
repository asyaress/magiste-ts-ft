<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap for SEO
     * Route: Route::get('/sitemap.xml', [SitemapController::class, 'index']);
     */
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $sitemap .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        // Homepage - Priority Tertinggi
        $sitemap .= $this->addUrl(url('/'), Carbon::now(), '1.0', 'daily');

        // Static Pages - Priority Tinggi
        $staticPages = [
            'tentang-kami' => ['priority' => '0.9', 'changefreq' => 'monthly'],
            'program-studi' => ['priority' => '0.9', 'changefreq' => 'monthly'],
            'pendaftaran' => ['priority' => '0.9', 'changefreq' => 'weekly'],
            'kontak' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            'fasilitas' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            'dosen' => ['priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        foreach ($staticPages as $page => $config) {
            $sitemap .= $this->addUrl(
                url($page),
                Carbon::now(),
                $config['priority'],
                $config['changefreq']
            );
        }

        // Blog Posts / Berita - Dynamic dari database
        // Uncomment jika sudah ada model Post/Article
        /*
        $posts = DB::table('posts')
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($posts as $post) {
            $sitemap .= $this->addUrl(
                url('blog/' . $post->slug),
                $post->updated_at,
                '0.7',
                'weekly'
            );
        }
        */

        // Projects / Penelitian - Dynamic
        /*
        $projects = DB::table('projects')
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($projects as $project) {
            $sitemap .= $this->addUrl(
                url('projects/' . $project->slug),
                $project->updated_at,
                '0.6',
                'monthly'
            );
        }
        */

        // Dosen / Staff - Dynamic
        /*
        $teachers = DB::table('teachers')
            ->where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($teachers as $teacher) {
            $sitemap .= $this->addUrl(
                url('dosen/' . $teacher->slug),
                $teacher->updated_at,
                '0.6',
                'monthly'
            );
        }
        */

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Generate image sitemap
     * Route: Route::get('/sitemap-images.xml', [SitemapController::class, 'images']);
     */
    public function images()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $sitemap .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        // Homepage images
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . url('/') . '</loc>';
        $sitemap .= '<image:image>';
        $sitemap .= '<image:loc>' . asset('assets/images/og-image.jpg') . '</image:loc>';
        $sitemap .= '<image:title>Program Magister Teknik Sipil UNMUL</image:title>';
        $sitemap .= '</image:image>';
        $sitemap .= '</url>';

        // Gallery images - Dynamic
        /*
        $galleries = DB::table('galleries')
            ->where('is_visible', true)
            ->get();

        foreach ($galleries as $gallery) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url('galeri/' . $gallery->slug) . '</loc>';
            $sitemap .= '<image:image>';
            $sitemap .= '<image:loc>' . asset($gallery->image_path) . '</image:loc>';
            $sitemap .= '<image:title>' . htmlspecialchars($gallery->title) . '</image:title>';
            $sitemap .= '<image:caption>' . htmlspecialchars($gallery->description) . '</image:caption>';
            $sitemap .= '</image:image>';
            $sitemap .= '</url>';
        }
        */

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Helper: Add URL to sitemap
     */
    private function addUrl($loc, $lastmod, $priority, $changefreq)
    {
        $url = '<url>';
        $url .= '<loc>' . htmlspecialchars($loc) . '</loc>';
        $url .= '<lastmod>' . $lastmod->toAtomString() . '</lastmod>';
        $url .= '<changefreq>' . $changefreq . '</changefreq>';
        $url .= '<priority>' . $priority . '</priority>';
        $url .= '</url>';

        return $url;
    }

    /**
     * Sitemap index (jika ada multiple sitemaps)
     * Route: Route::get('/sitemap-index.xml', [SitemapController::class, 'sitemapIndex']);
     */
    public function sitemapIndex()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Main sitemap
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>' . url('sitemap.xml') . '</loc>';
        $sitemap .= '<lastmod>' . Carbon::now()->toAtomString() . '</lastmod>';
        $sitemap .= '</sitemap>';

        // Image sitemap
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>' . url('sitemap-images.xml') . '</loc>';
        $sitemap .= '<lastmod>' . Carbon::now()->toAtomString() . '</lastmod>';
        $sitemap .= '</sitemap>';

        // Posts sitemap (jika banyak post)
        /*
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>' . url('sitemap-posts.xml') . '</loc>';
        $sitemap .= '<lastmod>' . Carbon::now()->toAtomString() . '</lastmod>';
        $sitemap .= '</sitemap>';
        */

        $sitemap .= '</sitemapindex>';

        return response($sitemap, 200)
            ->header('Content-Type', 'text/xml');
    }
}

<?php

use App\Models\TeacherSection;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\ResearchTopicController;
use App\Http\Controllers\Admin\TeacherSectionController;
use App\Http\Controllers\Admin\GallerySectionController;
use App\Http\Controllers\Admin\ResearchSectionController;
use App\Http\Controllers\Admin\VideoGalleryItemController;
use App\Http\Controllers\Admin\VideoGallerySectionController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\BlogSectionController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeFaqItemController;
use App\Http\Controllers\Admin\HomeHeroSlideController;
use App\Http\Controllers\Admin\HomeMissionItemController;
use App\Http\Controllers\SitemapController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/sitemap-images.xml', [SitemapController::class, 'images']);


Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');


Route::get('/team', function () {
    $section = Illuminate\Support\Facades\Cache::remember('homepage:team-page-section', 3600, function () {
        return TeacherSection::active()
            ->with('teachers')
            ->orderBy('sort_order')
            ->first();
    });

    abort_unless($section, 404);

    return view('pages.team', compact('section'));
})->name('teams.index');

Route::get('/about', function () {
    return view('pages.about');
})->name('about.index');

Route::get('/struktur-organisasi', function () {
    return view('pages.struktur-organisasi');
})->name('struktur.index');

Route::get('/akreditasi', function () {
    return view('pages.akreditasi');
})->name('akreditasi.index');

Route::get('/kurikulum', function () {
    return view('pages.kurikulum');
})->name('kurikulum.index');

Route::get('/jadwal', function () {
    return view('pages.mata-kuliah');
})->name('jadwal.index');

Route::get('/kalender', function () {
    return view('pages.kalender');
})->name('kalender.index');

Route::get('/penelitian-pengabdian', function () {
    return view('pages.penelitiandanpengabdian');
})->name('penelitiandanpengabdian.index');

Route::get('/kerjasama', function () {
    return view('pages.kerjasama');
})->name('kerjasama.index');

Route::get('/jurnal', function () {
    return view('pages.jurnal');
})->name('jurnal.index');

Route::get('/buku', function () {
    return view('pages.buku');
})->name('buku.index');

Route::get('/hki', function () {
    return view('pages.hki');
})->name('hki.index');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt');
        Route::get('/setup', [AdminAuthController::class, 'showSetup'])->name('setup');
        Route::post('/setup', [AdminAuthController::class, 'setup'])->name('setup.store');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth')->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/research-topics', [ResearchTopicController::class, 'index'])->name('research-topics.index');
        Route::post('/research-topics', [ResearchTopicController::class, 'store'])->name('research-topics.store');
        Route::get('/research-topics/{topic}/edit', [ResearchTopicController::class, 'edit'])->name('research-topics.edit');
        Route::put('/research-topics/{topic}', [ResearchTopicController::class, 'update'])->name('research-topics.update');
        Route::delete('/research-topics/{topic}', [ResearchTopicController::class, 'destroy'])->name('research-topics.destroy');
        Route::get('/research-sections', [ResearchSectionController::class, 'index'])->name('research-sections.index');
        Route::post('/research-sections', [ResearchSectionController::class, 'store'])->name('research-sections.store');
        Route::put('/research-sections/{section}', [ResearchSectionController::class, 'update'])->name('research-sections.update');
        Route::delete('/research-sections/{section}', [ResearchSectionController::class, 'destroy'])->name('research-sections.destroy');

        Route::get('/video-gallery-items', [VideoGalleryItemController::class, 'index'])->name('video-items.index');
        Route::post('/video-gallery-items', [VideoGalleryItemController::class, 'store'])->name('video-items.store');
        Route::get('/video-gallery-items/{item}/edit', [VideoGalleryItemController::class, 'edit'])->name('video-items.edit');
        Route::put('/video-gallery-items/{item}', [VideoGalleryItemController::class, 'update'])->name('video-items.update');
        Route::delete('/video-gallery-items/{item}', [VideoGalleryItemController::class, 'destroy'])->name('video-items.destroy');
        Route::get('/video-gallery-sections', [VideoGallerySectionController::class, 'index'])->name('video-sections.index');
        Route::post('/video-gallery-sections', [VideoGallerySectionController::class, 'store'])->name('video-sections.store');
        Route::put('/video-gallery-sections/{section}', [VideoGallerySectionController::class, 'update'])->name('video-sections.update');
        Route::delete('/video-gallery-sections/{section}', [VideoGallerySectionController::class, 'destroy'])->name('video-sections.destroy');

        Route::get('/gallery-items', [GalleryItemController::class, 'index'])->name('gallery-items.index');
        Route::post('/gallery-items', [GalleryItemController::class, 'store'])->name('gallery-items.store');
        Route::get('/gallery-items/{item}/edit', [GalleryItemController::class, 'edit'])->name('gallery-items.edit');
        Route::put('/gallery-items/{item}', [GalleryItemController::class, 'update'])->name('gallery-items.update');
        Route::delete('/gallery-items/{item}', [GalleryItemController::class, 'destroy'])->name('gallery-items.destroy');
        Route::get('/gallery-sections', [GallerySectionController::class, 'index'])->name('gallery-sections.index');
        Route::post('/gallery-sections', [GallerySectionController::class, 'store'])->name('gallery-sections.store');
        Route::put('/gallery-sections/{section}', [GallerySectionController::class, 'update'])->name('gallery-sections.update');
        Route::delete('/gallery-sections/{section}', [GallerySectionController::class, 'destroy'])->name('gallery-sections.destroy');

        Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
        Route::get('/teacher-sections', [TeacherSectionController::class, 'index'])->name('teacher-sections.index');
        Route::post('/teacher-sections', [TeacherSectionController::class, 'store'])->name('teacher-sections.store');
        Route::put('/teacher-sections/{section}', [TeacherSectionController::class, 'update'])->name('teacher-sections.update');
        Route::delete('/teacher-sections/{section}', [TeacherSectionController::class, 'destroy'])->name('teacher-sections.destroy');

        Route::get('/blog-posts', [BlogPostController::class, 'index'])->name('blog-posts.index');
        Route::post('/blog-posts', [BlogPostController::class, 'store'])->name('blog-posts.store');
        Route::post('/blog-posts/editor-image', [BlogPostController::class, 'uploadEditorImage'])->name('blog-posts.editor-image');
        Route::get('/blog-posts/{post}/edit', [BlogPostController::class, 'edit'])->name('blog-posts.edit');
        Route::put('/blog-posts/{post}', [BlogPostController::class, 'update'])->name('blog-posts.update');
        Route::delete('/blog-posts/{post}', [BlogPostController::class, 'destroy'])->name('blog-posts.destroy');

        Route::get('/blog-sections', [BlogSectionController::class, 'index'])->name('blog-sections.index');
        Route::post('/blog-sections', [BlogSectionController::class, 'store'])->name('blog-sections.store');
        Route::put('/blog-sections/{section}', [BlogSectionController::class, 'update'])->name('blog-sections.update');
        Route::delete('/blog-sections/{section}', [BlogSectionController::class, 'destroy'])->name('blog-sections.destroy');

        Route::get('/home-hero-slides', [HomeHeroSlideController::class, 'index'])->name('home-hero-slides.index');
        Route::post('/home-hero-slides', [HomeHeroSlideController::class, 'store'])->name('home-hero-slides.store');
        Route::put('/home-hero-slides/{slide}', [HomeHeroSlideController::class, 'update'])->name('home-hero-slides.update');
        Route::delete('/home-hero-slides/{slide}', [HomeHeroSlideController::class, 'destroy'])->name('home-hero-slides.destroy');

        Route::get('/home-mission-items', [HomeMissionItemController::class, 'index'])->name('home-mission-items.index');
        Route::post('/home-mission-items', [HomeMissionItemController::class, 'store'])->name('home-mission-items.store');
        Route::put('/home-mission-items/{item}', [HomeMissionItemController::class, 'update'])->name('home-mission-items.update');
        Route::delete('/home-mission-items/{item}', [HomeMissionItemController::class, 'destroy'])->name('home-mission-items.destroy');

        Route::get('/home-faq-items', [HomeFaqItemController::class, 'index'])->name('home-faq-items.index');
        Route::post('/home-faq-items', [HomeFaqItemController::class, 'store'])->name('home-faq-items.store');
        Route::put('/home-faq-items/{item}', [HomeFaqItemController::class, 'update'])->name('home-faq-items.update');
        Route::delete('/home-faq-items/{item}', [HomeFaqItemController::class, 'destroy'])->name('home-faq-items.destroy');

        Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
        Route::put('/site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
    });
});

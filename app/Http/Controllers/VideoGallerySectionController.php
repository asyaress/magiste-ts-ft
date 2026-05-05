<?php

namespace App\Http\Controllers;

use App\Models\VideoGallerySection;
use Illuminate\Http\Request;

class VideoGallerySectionController extends Controller
{
    public function show(Request $request, string $slug = 'video-gallery')
    {
        $section = VideoGallerySection::with('items')
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('front.video-gallery', compact('section'));
    }
}

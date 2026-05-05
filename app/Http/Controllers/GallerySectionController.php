<?php

namespace App\Http\Controllers;

use App\Models\GallerySection;
use Illuminate\Http\Request;

class GallerySectionController extends Controller
{
    public function show(Request $request, string $slug = 'galeri')
    {
        $section = GallerySection::with('items')
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('front.gallery', compact('section'));
    }
}

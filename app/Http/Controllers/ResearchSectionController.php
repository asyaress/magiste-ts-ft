<?php

namespace App\Http\Controllers;

use App\Models\ResearchSection;
use Illuminate\Http\Request;

class ResearchSectionController extends Controller
{
    /**
     * Tampilkan section riset beserta daftar topiknya.
     * Default: slug "riset-tesis"
     */
    public function show(Request $request, string $slug = 'riset-tesis')
    {
        $section = ResearchSection::with('topics')->active()->where('slug', $slug)->firstOrFail();

        return view('pages.home', [
            'section' => $section
        ]);
    }
}

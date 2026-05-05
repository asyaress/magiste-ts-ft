<?php

namespace App\Http\Controllers;

use App\Models\TeacherSection;
use Illuminate\Http\Request;

class TeacherSectionController extends Controller
{
    public function show(Request $request, string $slug = 'dosen-pengajar')
    {
        $section = TeacherSection::with('teachers')
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('front.teachers', compact('section'));
    }
}

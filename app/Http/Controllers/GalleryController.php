<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('pages.gallery', [
            'galleries' => Gallery::published()->orderBy('sort_order')->latest()->paginate(12),
            'categories' => Gallery::published()->whereNotNull('category')->distinct()->pluck('category'),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Msme;
use Illuminate\View\View;

class MsmeController extends Controller
{
    public function index(): View
    {
        return view('pages.msmes.index', [
            'msmes' => Msme::published()->latest()->paginate(9),
            'categories' => Msme::published()->whereNotNull('category')->distinct()->pluck('category'),
        ]);
    }

    public function show(string $slug): View
    {
        return view('pages.msmes.show', [
            'msme' => Msme::published()->where('slug', $slug)->firstOrFail(),
        ]);
    }
}

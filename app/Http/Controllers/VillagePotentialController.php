<?php

namespace App\Http\Controllers;

use App\Models\VillagePotential;
use Illuminate\View\View;

class VillagePotentialController extends Controller
{
    public function index(): View
    {
        return view('pages.potentials.index', [
            'potentials' => VillagePotential::published()->latest()->paginate(9),
            'categories' => VillagePotential::published()->whereNotNull('category')->distinct()->pluck('category'),
        ]);
    }

    public function show(string $slug): View
    {
        return view('pages.potentials.show', [
            'potential' => VillagePotential::published()->where('slug', $slug)->firstOrFail(),
        ]);
    }
}

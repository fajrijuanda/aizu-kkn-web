<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Infographic;
use App\Models\MapPoint;
use App\Models\Msme;
use App\Models\VillagePotential;
use App\Models\VillageProfile;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'profile' => VillageProfile::query()->first(),
            'infographics' => Infographic::published()->orderBy('sort_order')->limit(6)->get(),
            'mapPoints' => MapPoint::published()->orderBy('sort_order')->limit(4)->get(),
            'msmes' => Msme::published()->where('is_featured', true)->latest()->limit(3)->get(),
            'potentials' => VillagePotential::published()->where('is_featured', true)->latest()->limit(3)->get(),
            'galleries' => Gallery::published()->orderBy('sort_order')->latest()->limit(6)->get(),
        ]);
    }
}

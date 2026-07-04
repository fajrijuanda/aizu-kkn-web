<?php

namespace App\Http\Controllers;

use App\Models\MapPoint;
use App\Models\VillageProfile;
use Illuminate\View\View;

class MapController extends Controller
{
    public function index(): View
    {
        return view('pages.map', [
            'profile' => VillageProfile::query()->first(),
            'mapPoints' => MapPoint::published()->orderBy('sort_order')->get(),
        ]);
    }
}

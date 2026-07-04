<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Infographic;
use App\Models\MapPoint;
use App\Models\Msme;
use App\Models\VillagePotential;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'Infografis' => Infographic::query()->count(),
                'Titik Peta' => MapPoint::query()->count(),
                'UMKM' => Msme::query()->count(),
                'Potensi' => VillagePotential::query()->count(),
                'Galeri' => Gallery::query()->count(),
            ],
            'drafts' => [
                'Infografis' => Infographic::query()->where('is_published', false)->count(),
                'UMKM' => Msme::query()->where('is_published', false)->count(),
                'Potensi' => VillagePotential::query()->where('is_published', false)->count(),
                'Galeri' => Gallery::query()->where('is_published', false)->count(),
            ],
        ]);
    }
}

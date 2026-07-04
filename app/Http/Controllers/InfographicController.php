<?php

namespace App\Http\Controllers;

use App\Models\Infographic;
use Illuminate\View\View;

class InfographicController extends Controller
{
    public function index(): View
    {
        return view('pages.infographics', [
            'groups' => Infographic::published()
                ->orderBy('category')
                ->orderBy('sort_order')
                ->get()
                ->groupBy('category'),
        ]);
    }
}

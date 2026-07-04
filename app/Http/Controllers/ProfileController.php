<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\VillageProfile;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('pages.profile', [
            'profile' => VillageProfile::query()->first(),
            'contacts' => Contact::published()->orderBy('sort_order')->get(),
        ]);
    }
}

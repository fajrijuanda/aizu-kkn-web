<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VillageProfile;
use App\Services\Base64ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('admin.profile.edit', [
            'profile' => VillageProfile::query()->firstOrCreate(['id' => 1], ['name' => 'Desa KKN AIZU']),
        ]);
    }

    public function update(Request $request, Base64ImageService $images): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'regency' => ['nullable', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:50'],
            'area' => ['nullable', 'string', 'max:255'],
            'head_name' => ['nullable', 'string', 'max:255'],
            'head_greeting' => ['nullable', 'string'],
            'history' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'missions_text' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'map_embed_url' => ['nullable', 'string'],
            'hero_image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'logo_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
        ]);

        $profile = VillageProfile::query()->firstOrCreate(['id' => 1], ['name' => $data['name']]);

        $data['missions'] = collect(preg_split('/\r\n|\r|\n/', $data['missions_text'] ?? ''))
            ->map(fn (string $mission): string => trim($mission))
            ->filter()
            ->values()
            ->all();
        unset($data['missions_text'], $data['hero_image_upload'], $data['logo_upload']);

        if ($request->hasFile('hero_image_upload')) {
            $image = $images->encode($request->file('hero_image_upload'), 'Hero '.$data['name']);
            $data['hero_image_base64'] = $image['src'];
            $data['hero_image_mime_type'] = $image['mime_type'];
            $data['hero_image_alt'] = $image['alt'];
        }

        if ($request->hasFile('logo_upload')) {
            $image = $images->encode($request->file('logo_upload'), 'Logo '.$data['name']);
            $data['logo_base64'] = $image['src'];
            $data['logo_mime_type'] = $image['mime_type'];
        }

        $profile->update($data);

        return back()->with('status', 'Profil desa berhasil diperbarui.');
    }
}

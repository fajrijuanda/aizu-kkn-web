<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\Base64ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => SiteSetting::query()->pluck('value', 'key'),
        ]);
    }

    public function update(Request $request, Base64ImageService $images): RedirectResponse
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'footer_text' => ['nullable', 'string', 'max:255'],
            'primary_color' => ['nullable', 'string', 'max:50'],
            'accent_color' => ['nullable', 'string', 'max:50'],
            'logo_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'favicon_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:512'],
        ]);

        foreach (collect($data)->except(['logo_upload', 'favicon_upload']) as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value, 'type' => 'text']);
        }

        if ($request->hasFile('logo_upload')) {
            $image = $images->encode($request->file('logo_upload'), 'Logo website');
            SiteSetting::query()->updateOrCreate(['key' => 'logo_base64'], ['value' => $image['src'], 'type' => 'image']);
        }

        if ($request->hasFile('favicon_upload')) {
            $image = $images->encode($request->file('favicon_upload'), 'Favicon website');
            SiteSetting::query()->updateOrCreate(['key' => 'favicon_base64'], ['value' => $image['src'], 'type' => 'image']);
        }

        return back()->with('status', 'Pengaturan website berhasil diperbarui.');
    }
}

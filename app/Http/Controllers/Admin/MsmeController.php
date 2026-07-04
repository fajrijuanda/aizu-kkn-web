<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Msme;
use App\Services\Base64ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MsmeController extends Controller
{
    public function index(): View
    {
        return view('admin.msmes.index', [
            'items' => Msme::query()->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.msmes.create', ['item' => new Msme()]);
    }

    public function store(Request $request, Base64ImageService $images): RedirectResponse
    {
        Msme::query()->create($this->validated($request, $images));

        return redirect()->route('admin.umkm.index')->with('status', 'UMKM berhasil ditambahkan.');
    }

    public function edit(Msme $msme): View
    {
        return view('admin.msmes.edit', ['item' => $msme]);
    }

    public function update(Request $request, Base64ImageService $images, Msme $msme): RedirectResponse
    {
        $msme->update($this->validated($request, $images, $msme));

        return redirect()->route('admin.umkm.index')->with('status', 'UMKM berhasil diperbarui.');
    }

    public function destroy(Msme $msme): RedirectResponse
    {
        $msme->delete();

        return back()->with('status', 'UMKM berhasil dihapus.');
    }

    private function validated(Request $request, Base64ImageService $images, ?Msme $msme = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('msmes', 'slug')->ignore($msme?->id)],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'products' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:255'],
            'map_url' => ['nullable', 'url'],
            'image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['gallery'] = $msme?->gallery ?? [];
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        unset($data['image_upload']);

        if ($request->hasFile('image_upload')) {
            $image = $images->encode($request->file('image_upload'), $data['name']);
            $data['image_base64'] = $image['src'];
            $data['image_mime_type'] = $image['mime_type'];
            $data['image_alt'] = $image['alt'];
        }

        return $data;
    }
}

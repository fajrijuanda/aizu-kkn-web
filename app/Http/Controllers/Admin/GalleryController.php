<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Services\Base64ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('admin.galleries.index', [
            'items' => Gallery::query()->orderBy('sort_order')->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.galleries.create', ['item' => new Gallery()]);
    }

    public function store(Request $request, Base64ImageService $images): RedirectResponse
    {
        Gallery::query()->create($this->validated($request, $images));

        return redirect()->route('admin.galeri.index')->with('status', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $galeri): View
    {
        return view('admin.galleries.edit', ['item' => $galeri]);
    }

    public function update(Request $request, Base64ImageService $images, Gallery $galeri): RedirectResponse
    {
        $galeri->update($this->validated($request, $images, $galeri));

        return redirect()->route('admin.galeri.index')->with('status', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $galeri): RedirectResponse
    {
        $galeri->delete();

        return back()->with('status', 'Foto galeri berhasil dihapus.');
    }

    private function validated(Request $request, Base64ImageService $images, ?Gallery $gallery = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'taken_at' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image_upload' => [$gallery ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_published'] = $request->boolean('is_published');
        unset($data['image_upload']);

        if ($request->hasFile('image_upload')) {
            $image = $images->encode($request->file('image_upload'), $data['title']);
            $data['image_base64'] = $image['src'];
            $data['image_mime_type'] = $image['mime_type'];
            $data['image_alt'] = $image['alt'];
        }

        return $data;
    }
}

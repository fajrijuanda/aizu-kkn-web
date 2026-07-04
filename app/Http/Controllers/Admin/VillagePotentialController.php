<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VillagePotential;
use App\Services\Base64ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VillagePotentialController extends Controller
{
    public function index(): View
    {
        return view('admin.potentials.index', [
            'items' => VillagePotential::query()->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.potentials.create', ['item' => new VillagePotential()]);
    }

    public function store(Request $request, Base64ImageService $images): RedirectResponse
    {
        VillagePotential::query()->create($this->validated($request, $images));

        return redirect()->route('admin.potensi-desa.index')->with('status', 'Potensi desa berhasil ditambahkan.');
    }

    public function edit(VillagePotential $potensi_desa): View
    {
        return view('admin.potentials.edit', ['item' => $potensi_desa]);
    }

    public function update(Request $request, Base64ImageService $images, VillagePotential $potensi_desa): RedirectResponse
    {
        $potensi_desa->update($this->validated($request, $images, $potensi_desa));

        return redirect()->route('admin.potensi-desa.index')->with('status', 'Potensi desa berhasil diperbarui.');
    }

    public function destroy(VillagePotential $potensi_desa): RedirectResponse
    {
        $potensi_desa->delete();

        return back()->with('status', 'Potensi desa berhasil dihapus.');
    }

    private function validated(Request $request, Base64ImageService $images, ?VillagePotential $potential = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('village_potentials', 'slug')->ignore($potential?->id)],
            'category' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['gallery'] = $potential?->gallery ?? [];
        $data['is_featured'] = $request->boolean('is_featured');
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

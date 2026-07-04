<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MapPoint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MapPointController extends Controller
{
    public function index(): View
    {
        return view('admin.map-points.index', [
            'items' => MapPoint::query()->orderBy('sort_order')->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.map-points.create', ['item' => new MapPoint()]);
    }

    public function store(Request $request): RedirectResponse
    {
        MapPoint::query()->create($this->validated($request));

        return redirect()->route('admin.peta-desa.index')->with('status', 'Titik peta berhasil ditambahkan.');
    }

    public function edit(MapPoint $peta_desa): View
    {
        return view('admin.map-points.edit', ['item' => $peta_desa]);
    }

    public function update(Request $request, MapPoint $peta_desa): RedirectResponse
    {
        $peta_desa->update($this->validated($request));

        return redirect()->route('admin.peta-desa.index')->with('status', 'Titik peta berhasil diperbarui.');
    }

    public function destroy(MapPoint $peta_desa): RedirectResponse
    {
        $peta_desa->delete();

        return back()->with('status', 'Titik peta berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'address' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'external_url' => ['nullable', 'url'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}

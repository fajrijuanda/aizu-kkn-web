<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infographic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InfographicController extends Controller
{
    public function index(): View
    {
        return view('admin.infographics.index', [
            'items' => Infographic::query()->orderBy('sort_order')->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.infographics.create', ['item' => new Infographic()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Infographic::query()->create($this->validated($request));

        return redirect()->route('admin.infografis.index')->with('status', 'Infografis berhasil ditambahkan.');
    }

    public function edit(Infographic $infografis): View
    {
        return view('admin.infographics.edit', ['item' => $infografis]);
    }

    public function update(Request $request, Infographic $infografis): RedirectResponse
    {
        $infografis->update($this->validated($request));

        return redirect()->route('admin.infografis.index')->with('status', 'Infografis berhasil diperbarui.');
    }

    public function destroy(Infographic $infografis): RedirectResponse
    {
        $infografis->delete();

        return back()->with('status', 'Infografis berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'category' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}

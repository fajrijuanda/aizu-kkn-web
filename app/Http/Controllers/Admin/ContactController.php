<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('admin.contacts.index', [
            'items' => Contact::query()->orderBy('sort_order')->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.contacts.create', ['item' => new Contact()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Contact::query()->create($this->validated($request));

        return redirect()->route('admin.kontak.index')->with('status', 'Kontak berhasil ditambahkan.');
    }

    public function edit(Contact $kontak): View
    {
        return view('admin.contacts.edit', ['item' => $kontak]);
    }

    public function update(Request $request, Contact $kontak): RedirectResponse
    {
        $kontak->update($this->validated($request));

        return redirect()->route('admin.kontak.index')->with('status', 'Kontak berhasil diperbarui.');
    }

    public function destroy(Contact $kontak): RedirectResponse
    {
        $kontak->delete();

        return back()->with('status', 'Kontak berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'value' => ['nullable', 'string'],
            'url' => ['nullable', 'url'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}

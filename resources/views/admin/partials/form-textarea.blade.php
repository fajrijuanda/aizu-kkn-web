@props(['name', 'label', 'value' => null, 'rows' => 4])

<label class="block">
    <span class="text-sm font-bold text-slate-700">{{ $label }}</span>
    <textarea
        name="{{ $name }}"
        rows="{{ $rows }}"
        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-green-600 focus:ring-2 focus:ring-green-100">{{ old($name, $value) }}</textarea>
</label>

@props(['name', 'label', 'type' => 'text', 'value' => null, 'required' => false])

<label class="block">
    <span class="text-sm font-bold text-slate-700">{{ $label }}</span>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        @required($required)
        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-green-600 focus:ring-2 focus:ring-green-100">
</label>

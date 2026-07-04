@props(['name', 'label', 'checked' => false])

<label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700">
    <input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $checked)) class="rounded border-slate-300 text-green-800">
    {{ $label }}
</label>

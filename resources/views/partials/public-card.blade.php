<a href="{{ $url }}" class="overflow-hidden rounded-2xl border border-green-100 bg-white shadow-sm transition hover:-translate-y-1 hover:border-green-300 hover:shadow-lg">
    @if ($image)
        <img src="{{ $image }}" alt="{{ $title }}" class="aspect-[4/3] w-full object-cover">
    @else
        <div class="aspect-[4/3] bg-green-100"></div>
    @endif
    <div class="p-5">
        <p class="text-xs font-bold uppercase text-amber-800">{{ $subtitle }}</p>
        <h3 class="mt-2 text-xl font-black text-green-950">{{ $title }}</h3>
        <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">{{ $description }}</p>
    </div>
</a>

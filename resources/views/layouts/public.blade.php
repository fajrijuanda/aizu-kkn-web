@php
    use App\Models\SiteSetting;
    use App\Models\VillageProfile;

    $globalProfile = $profile ?? VillageProfile::query()->first();
    $siteName = SiteSetting::value('site_name', $globalProfile?->name ?? config('app.name'));
    $description = SiteSetting::value('site_description', 'Portal informasi desa.');
    $favicon = SiteSetting::value('favicon_base64', $globalProfile?->logo_base64);
    $navItems = [
        ['label' => 'Beranda', 'route' => 'home'],
        ['label' => 'Profil', 'route' => 'profile'],
        ['label' => 'Infografis', 'route' => 'infographics'],
        ['label' => 'Peta', 'route' => 'map'],
        ['label' => 'UMKM', 'route' => 'msmes.index'],
        ['label' => 'Potensi', 'route' => 'potentials.index'],
        ['label' => 'Galeri', 'route' => 'gallery'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description }}">
        <title>{{ isset($title) ? $title.' - '.$siteName : $siteName }}</title>
        @if ($favicon)
            <link rel="icon" href="{{ $favicon }}">
        @endif
        @if (! app()->environment('testing') && (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-stone-50 text-slate-900 antialiased">
        <header class="sticky top-0 z-40 border-b border-green-100 bg-white/95 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    @if ($globalProfile?->logo_base64)
                        <img src="{{ $globalProfile->logo_base64 }}" alt="Logo {{ $globalProfile->name }}" class="h-11 w-11 rounded-xl border border-green-100 object-cover">
                    @else
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-green-800 text-sm font-bold text-white">A</span>
                    @endif
                    <span>
                        <span class="block text-sm font-bold leading-tight text-green-950 sm:text-base">{{ $globalProfile?->name ?? $siteName }}</span>
                        <span class="block text-xs text-stone-600">{{ $globalProfile?->regency ?? 'Portal Desa' }}</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 lg:flex">
                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}" class="rounded-full px-4 py-2 text-sm font-semibold transition {{ request()->routeIs($item['route']) ? 'bg-green-800 text-white' : 'text-slate-700 hover:bg-green-50 hover:text-green-900' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="hidden items-center gap-2 lg:flex">
                    <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-green-200 px-4 py-2 text-sm font-semibold text-green-900 hover:bg-green-50">Admin</a>
                </div>

                <details class="relative lg:hidden">
                    <summary class="list-none rounded-xl border border-green-100 px-3 py-2 text-sm font-semibold text-green-900">Menu</summary>
                    <div class="absolute right-0 mt-3 w-64 rounded-2xl border border-green-100 bg-white p-3 shadow-xl">
                        @foreach ($navItems as $item)
                            <a href="{{ route($item['route']) }}" class="block rounded-xl px-3 py-2 text-sm font-semibold {{ request()->routeIs($item['route']) ? 'bg-green-800 text-white' : 'text-slate-700 hover:bg-green-50' }}">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                        <a href="{{ route('admin.dashboard') }}" class="mt-2 block rounded-xl border border-green-100 px-3 py-2 text-sm font-semibold text-green-900">Admin</a>
                    </div>
                </details>
            </div>
        </header>

        <main>
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <footer class="border-t border-green-100 bg-green-950 text-green-50">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 md:grid-cols-[1.3fr_1fr_1fr] lg:px-8">
                <div>
                    <p class="text-lg font-bold">{{ $globalProfile?->name ?? $siteName }}</p>
                    <p class="mt-3 max-w-xl text-sm leading-6 text-green-100">{{ $globalProfile?->tagline ?? $description }}</p>
                    <p class="mt-4 text-sm text-green-100">{{ $globalProfile?->address }}</p>
                </div>
                <div>
                    <p class="font-semibold">Jelajahi</p>
                    <div class="mt-3 grid gap-2 text-sm text-green-100">
                        @foreach ($navItems as $item)
                            <a href="{{ route($item['route']) }}" class="hover:text-white">{{ $item['label'] }}</a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="font-semibold">Kontak</p>
                    <div class="mt-3 grid gap-2 text-sm text-green-100">
                        <span>{{ $globalProfile?->phone ?? '-' }}</span>
                        <span>{{ $globalProfile?->email ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/10 py-4 text-center text-xs text-green-100">
                {{ SiteSetting::value('footer_text', 'Dikelola oleh Tim KKN AIZU') }}
            </div>
        </footer>
    </body>
</html>

@php
    $navItems = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
        ['label' => 'Profil Desa', 'route' => 'admin.profile.edit'],
        ['label' => 'Infografis', 'route' => 'admin.infografis.index'],
        ['label' => 'Peta Desa', 'route' => 'admin.peta-desa.index'],
        ['label' => 'UMKM', 'route' => 'admin.umkm.index'],
        ['label' => 'Potensi', 'route' => 'admin.potensi-desa.index'],
        ['label' => 'Galeri', 'route' => 'admin.galeri.index'],
        ['label' => 'Kontak', 'route' => 'admin.kontak.index'],
        ['label' => 'Pengaturan', 'route' => 'admin.settings.edit'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ isset($title) ? $title.' - Admin Desa' : 'Admin Desa' }}</title>
        @if (! app()->environment('testing') && (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-stone-50 text-slate-900">
        <div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
            <aside class="hidden border-r border-green-900/20 bg-green-950 p-5 text-green-50 lg:block">
                <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl bg-white/10 p-4">
                    <p class="text-lg font-black">Admin Desa</p>
                    <p class="mt-1 text-xs text-green-100">KKN AIZU Web</p>
                </a>
                <nav class="mt-6 grid gap-1">
                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}" class="rounded-xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs($item['route']) ? 'bg-amber-800 text-white' : 'text-green-50 hover:bg-white/10' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </aside>

            <div>
                <header class="sticky top-0 z-30 border-b border-green-100 bg-white/95 backdrop-blur">
                    <div class="flex items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                        <div>
                            <p class="text-xs font-bold uppercase text-amber-800">Admin Panel</p>
                            <h1 class="text-xl font-black text-green-950">{{ $title ?? 'Dashboard' }}</h1>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('home') }}" class="rounded-full border border-green-200 px-4 py-2 text-sm font-bold text-green-900 hover:bg-green-50">Lihat Web</a>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button class="rounded-full bg-green-900 px-4 py-2 text-sm font-bold text-white hover:bg-green-950">Logout</button>
                            </form>
                        </div>
                    </div>
                    <details class="border-t border-green-100 px-4 py-2 lg:hidden">
                        <summary class="list-none text-sm font-bold text-green-950">Menu admin</summary>
                        <nav class="mt-2 grid gap-1 pb-2">
                            @foreach ($navItems as $item)
                                <a href="{{ route($item['route']) }}" class="rounded-xl px-3 py-2 text-sm font-semibold {{ request()->routeIs($item['route']) ? 'bg-green-800 text-white' : 'text-slate-700 hover:bg-green-50' }}">{{ $item['label'] }}</a>
                            @endforeach
                        </nav>
                    </details>
                </header>

                <main class="px-4 py-8 sm:px-6 lg:px-8">
                    @if (session('status'))
                        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-900">{{ session('status') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            <p class="font-bold">Ada input yang perlu diperbaiki.</p>
                            <ul class="mt-2 list-inside list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>

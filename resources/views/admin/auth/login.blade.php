<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Admin Desa</title>
        @if (! app()->environment('testing') && (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-green-950">
        <main class="grid min-h-screen place-items-center px-4 py-10">
            <form method="POST" action="{{ route('admin.login.store') }}" class="w-full max-w-md rounded-3xl border border-white/10 bg-white p-8 shadow-2xl">
                @csrf
                <p class="text-sm font-bold uppercase text-amber-800">Admin Panel</p>
                <h1 class="mt-2 text-3xl font-black text-green-950">Masuk Admin</h1>
                <p class="mt-3 text-sm leading-6 text-slate-600">Kelola profil desa, UMKM, potensi, peta, dan galeri.</p>

                @if ($errors->any())
                    <div class="mt-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>
                @endif

                <label class="mt-6 block text-sm font-bold text-slate-700" for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-green-600 focus:ring-2 focus:ring-green-100">

                <label class="mt-4 block text-sm font-bold text-slate-700" for="password">Password</label>
                <input id="password" name="password" type="password" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-green-600 focus:ring-2 focus:ring-green-100">

                <label class="mt-4 flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-green-800">
                    Ingat saya
                </label>

                <button class="mt-6 w-full rounded-xl bg-green-800 px-5 py-3 text-sm font-bold text-white hover:bg-green-900">Masuk</button>
                <a href="{{ route('home') }}" class="mt-4 block text-center text-sm font-semibold text-green-900">Kembali ke website</a>
            </form>
        </main>
    </body>
</html>

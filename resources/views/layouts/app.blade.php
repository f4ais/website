<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@php
    $role = auth()->user()->role;
    $menus = match ($role) {
        'admin' => [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'pattern' => 'admin.dashboard'],
            ['label' => 'Kelola Akun', 'route' => 'admin.users.index', 'pattern' => 'admin.users.*'],
            ['label' => 'Program Bantuan', 'route' => 'admin.programs.index', 'pattern' => 'admin.programs.*'],
            ['label' => 'Data Warga', 'route' => 'admin.citizens.index', 'pattern' => 'admin.citizens.*'],
            ['label' => 'Hasil Verifikasi', 'route' => 'admin.verifications.index', 'pattern' => 'admin.verifications.*'],
            ['label' => 'Ranking Prioritas', 'route' => 'admin.priorities.index', 'pattern' => 'admin.priorities.*'],
            ['label' => 'Penerima Bantuan', 'route' => 'admin.recipients.index', 'pattern' => 'admin.recipients.*'],
            ['label' => 'Laporan', 'route' => 'admin.reports.index', 'pattern' => 'admin.reports.*'],
        ],
        'rtrw' => [
            ['label' => 'Dashboard', 'route' => 'rtrw.dashboard', 'pattern' => 'rtrw.dashboard'],
            ['label' => 'Data Warga', 'route' => 'rtrw.citizens.index', 'pattern' => 'rtrw.citizens.*'],
        ],
        'surveyor' => [
            ['label' => 'Dashboard', 'route' => 'surveyor.dashboard', 'pattern' => 'surveyor.dashboard'],
            ['label' => 'Daftar Survei', 'route' => 'surveyor.surveys.index', 'pattern' => 'surveyor.surveys.*'],
        ],
        'penyalur' => [
            ['label' => 'Dashboard', 'route' => 'penyalur.dashboard', 'pattern' => 'penyalur.dashboard'],
            ['label' => 'Daftar Penerima', 'route' => 'penyalur.distributions.index', 'pattern' => 'penyalur.distributions.*'],
        ],
        default => [],
    };
@endphp
<div class="min-h-screen lg:flex">
    <aside class="border-b border-emerald-800 bg-emerald-950 text-white lg:fixed lg:inset-y-0 lg:w-72 lg:border-b-0 lg:border-r">
        <div class="flex h-20 items-center gap-3 px-6">
            <div class="grid h-11 w-11 place-items-center rounded-2xl bg-white font-black text-emerald-800">SB</div>
            <div>
                <div class="font-bold tracking-wide">SIPBANSOS</div>
                <div class="text-xs text-emerald-200">Verifikasi & Prioritas</div>
            </div>
        </div>
        <nav class="flex gap-2 overflow-x-auto px-4 pb-4 lg:block lg:space-y-1 lg:overflow-visible lg:pb-0">
            @foreach($menus as $menu)
                <a href="{{ route($menu['route']) }}"
                   class="block shrink-0 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs($menu['pattern']) ? 'bg-white text-emerald-900 shadow-sm' : 'text-emerald-100 hover:bg-emerald-900 hover:text-white' }}">
                    {{ $menu['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="hidden border-t border-emerald-800 p-5 lg:absolute lg:inset-x-0 lg:bottom-0 lg:block">
            <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
            <p class="mt-1 text-xs uppercase tracking-wider text-emerald-300">{{ $role }} {{ auth()->user()->wilayah ? '• '.auth()->user()->wilayah : '' }}</p>
            <form action="{{ route('logout') }}" method="POST" class="mt-4">@csrf
                <button class="w-full rounded-xl border border-emerald-700 px-3 py-2 text-sm hover:bg-emerald-900">Keluar</button>
            </form>
        </div>
    </aside>

    <div class="min-w-0 flex-1 lg:ml-72">
        <header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-5 backdrop-blur lg:px-8">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">{{ ucfirst($role) }}</p>
                <h1 class="font-semibold text-slate-900">@yield('page-title', 'SIPBANSOS')</h1>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="lg:hidden">@csrf
                <button class="rounded-lg border border-slate-300 px-3 py-2 text-sm">Keluar</button>
            </form>
        </header>
        <main class="p-5 lg:p-8">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    <p class="font-semibold">Periksa kembali data berikut:</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>

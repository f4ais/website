<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bantuan Sosial</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-slate-900 text-white">

        <div class="p-6 text-2xl font-bold border-b border-slate-700">
            Bantuan Sosial
        </div>

        <nav class="mt-5 space-y-1">

            <a href="{{ route('dashboard') }}"
                class="block px-6 py-3 hover:bg-slate-800 transition rounded">
                🏠 Dashboard
            </a>

            <a href="{{ route('warga.index') }}"
                class="block px-6 py-3 hover:bg-slate-800 transition rounded">
                👨👩👧 Data Warga
            </a>

            <a href="{{ route('survey.index') }}"
                class="block px-6 py-3 hover:bg-slate-800 transition rounded">
                📋 Survey
            </a>

            <a href="{{ route('program.index') }}"
                class="block px-6 py-3 hover:bg-slate-800 transition rounded">
                🎁 Program Bantuan
            </a>

            <a href="{{ route('rekomendasi.index') }}"
                class="block px-6 py-3 hover:bg-slate-800 transition rounded">
                ⭐ Rekomendasi
            </a>

            <a href="{{ route('penyaluran.index') }}"
                class="block px-6 py-3 hover:bg-slate-800 transition rounded"> 
                📦 Penyaluran
            </a>

        </nav>

    </aside>

    {{-- Content --}}
    <div class="flex-1 flex flex-col">

        {{-- Navbar --}}
        <header class="bg-white shadow px-8 py-4 flex justify-between items-center">

            <h2 class="text-xl font-bold text-gray-700">
                Bantuan Sosial
            </h2>

            <div class="flex items-center gap-4">

                <span class="text-gray-600">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Logout
                    </button>

                </form>

            </div>

        </header>

        {{-- Isi Halaman --}}
        <main class="flex-1 p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
... (1 line left)
<aside class="w-64 bg-slate-900 text-white min-h-screen">

    <div class="p-6 text-2xl font-bold border-b border-slate-700">
        Bantuan Sosial
    </div>

    <nav class="mt-5">

        <a href="{{ route('dashboard') }}"
           class="block px-6 py-3 hover:bg-slate-800">
            🏠 Dashboard
        </a>

        <a href="{{ route('warga.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">
            👨👩👧 Data Warga
        </a>

        <a href="{{ route('survey.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">
            📋 Survey
        </a>

        <a href="{{ route('program.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">
            🎁 Program Bantuan
        </a>

        <a href="{{ route('rekomendasi.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">
            ⭐ Rekomendasi
        </a>

        <a href="{{ route('penyaluran.index') }}"
           class="block px-6 py-3 hover:bg-slate-800">
            📦 Penyaluran
        </a>

    </nav>

</aside>
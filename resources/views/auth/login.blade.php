@extends('layouts.guest')
@section('title', 'Masuk')
@section('content')
<div class="grid w-full max-w-5xl overflow-hidden rounded-3xl bg-white shadow-2xl lg:grid-cols-2">
    <section class="hidden bg-emerald-950 p-12 text-white lg:flex lg:flex-col lg:justify-between">
        <div>
            <div class="grid h-14 w-14 place-items-center rounded-2xl bg-white text-xl font-black text-emerald-900">SB</div>
            <h1 class="mt-8 text-4xl font-black leading-tight">Data tepat.<br>Bantuan lebih bermanfaat.</h1>
            <p class="mt-5 max-w-md text-emerald-100">Sistem terintegrasi untuk pendataan warga, survei lapangan, pemeringkatan prioritas, penetapan penerima, dan dokumentasi penyaluran bantuan sosial.</p>
        </div>
        <p class="text-xs text-emerald-300">SIPBANSOS • Sistem Verifikasi dan Prioritas</p>
    </section>
    <section class="p-7 sm:p-10 lg:p-12">
        <div class="mb-8 lg:hidden">
            <div class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-900 font-black text-white">SB</div>
        </div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Selamat datang</p>
        <h2 class="mt-2 text-3xl font-bold text-slate-900">Masuk ke akun Anda</h2>
        <p class="mt-2 text-sm text-slate-500">Gunakan akun sesuai peran yang sudah dibuat oleh admin.</p>

        @if($errors->any())
            <div class="mt-6 rounded-xl bg-rose-50 p-4 text-sm text-rose-700">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="mt-8 space-y-5">@csrf
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100" placeholder="nama@email.com">
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                <input type="password" name="password" required class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100" placeholder="••••••••">
            </div>
            <label class="flex items-center gap-2 text-sm text-slate-600"><input type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-700"> Ingat saya</label>
            <button class="w-full rounded-xl bg-emerald-800 px-4 py-3 font-semibold text-white shadow-lg shadow-emerald-900/20 transition hover:bg-emerald-900">Masuk</button>
        </form>
        <div class="mt-8 rounded-xl bg-slate-50 p-4 text-xs leading-6 text-slate-600">
            <strong>Akun demo:</strong> admin@sipbansos.test, rtrw@sipbansos.test, surveyor@sipbansos.test, atau penyalur@sipbansos.test. Password: <code class="rounded bg-white px-1.5 py-0.5">password</code>.
        </div>
    </section>
</div>
@endsection

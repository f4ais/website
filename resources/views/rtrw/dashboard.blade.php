@extends('layouts.app')
@section('title', 'Dashboard RT/RW')
@section('page-title', 'Dashboard RT/RW')
@section('content')
<div class="mb-6 rounded-2xl bg-emerald-900 p-6 text-white"><p class="text-sm text-emerald-200">Wilayah kerja</p><h2 class="mt-1 text-2xl font-bold">{{ auth()->user()->wilayah }}</h2><p class="mt-2 text-sm text-emerald-100">Anda hanya dapat mengelola dan melihat warga pada wilayah ini.</p></div>
<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <x-stat-card label="Total Warga" :value="$stats['warga']" />
    <x-stat-card label="Belum Ditugaskan" :value="$stats['pending']" />
    <x-stat-card label="Sedang Disurvei" :value="$stats['assigned']" />
    <x-stat-card label="Terverifikasi" :value="$stats['verified']" />
</div>
<div class="mt-8 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
    <div class="flex flex-wrap items-center justify-between gap-3"><div><h2 class="font-bold">Data Warga Terbaru</h2><p class="text-sm text-slate-500">Warga yang baru didaftarkan di wilayah Anda.</p></div><a href="{{ route('rtrw.citizens.create') }}" class="rounded-xl bg-emerald-800 px-4 py-2.5 text-sm font-semibold text-white">Tambah Warga</a></div>
    <div class="mt-5 grid gap-3 md:grid-cols-2">
        @forelse($latestCitizens as $citizen)
            <a href="{{ route('rtrw.citizens.status', $citizen) }}" class="rounded-xl border border-slate-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50"><div class="flex items-start justify-between gap-3"><div><p class="font-semibold">{{ $citizen->name }}</p><p class="mt-1 text-xs text-slate-500">NIK {{ $citizen->nik }}</p></div><x-status-badge :status="$citizen->verification_status" /></div></a>
        @empty<div class="md:col-span-2"><x-empty-state message="Belum ada warga pada wilayah Anda." /></div>@endforelse
    </div>
</div>
@endsection

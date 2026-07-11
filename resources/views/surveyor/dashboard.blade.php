@extends('layouts.app')
@section('title', 'Dashboard Surveyor')
@section('page-title', 'Dashboard Surveyor')
@section('content')
<div class="grid gap-4 sm:grid-cols-3">
    <x-stat-card label="Tugas Aktif" :value="$stats['assigned']" hint="Survei yang harus diselesaikan" />
    <x-stat-card label="Terverifikasi" :value="$stats['verified']" />
    <x-stat-card label="Ditolak" :value="$stats['rejected']" />
</div>
<div class="mt-8 rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 p-5"><div><h2 class="font-bold">Jadwal Survei</h2><p class="text-sm text-slate-500">Tugas aktif yang diurutkan berdasarkan jadwal.</p></div><a class="text-sm font-semibold text-emerald-700" href="{{ route('surveyor.surveys.index') }}">Semua tugas</a></div>
    <div class="divide-y divide-slate-100">
        @forelse($upcoming as $survey)
            <a href="{{ route('surveyor.surveys.show', $survey) }}" class="flex flex-wrap items-center justify-between gap-4 p-5 hover:bg-slate-50"><div><p class="font-semibold">{{ $survey->citizen->name }}</p><p class="mt-1 text-sm text-slate-500">{{ $survey->citizen->address }} • {{ $survey->citizen->wilayah }}</p></div><div class="text-right"><p class="text-sm font-medium">{{ optional($survey->scheduled_at)->format('d M Y, H:i') ?? 'Belum dijadwalkan' }}</p><x-status-badge class="mt-2" :status="$survey->status" /></div></a>
        @empty<div class="p-5"><x-empty-state message="Tidak ada tugas survei aktif." /></div>@endforelse
    </div>
</div>
@endsection

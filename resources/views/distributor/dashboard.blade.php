@extends('layouts.app')
@section('title', 'Dashboard Penyalur')
@section('page-title', 'Dashboard Penyalur Bantuan')
@section('content')
<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <x-stat-card label="Siap Disalurkan" :value="$stats['ditetapkan']" />
    <x-stat-card label="Dalam Proses" :value="$stats['diproses']" />
    <x-stat-card label="Tersalurkan" :value="$stats['tersalurkan']" />
    <x-stat-card label="Gagal" :value="$stats['gagal']" />
</div>
<div class="mt-8 rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 p-5"><div><h2 class="font-bold">Daftar Penyaluran Terbaru</h2><p class="text-sm text-slate-500">Perbarui status dan dokumentasi penyaluran.</p></div><a class="text-sm font-semibold text-emerald-700" href="{{ route('penyalur.distributions.index') }}">Lihat daftar</a></div>
    <div class="divide-y divide-slate-100">
        @forelse($latest as $recipient)
            <a href="{{ route('penyalur.distributions.show', $recipient) }}" class="flex flex-wrap items-center justify-between gap-4 p-5 hover:bg-slate-50"><div><p class="font-semibold">{{ $recipient->citizen->name }}</p><p class="mt-1 text-sm text-slate-500">{{ $recipient->program->name }} • {{ $recipient->citizen->wilayah }}</p></div><x-status-badge :status="$recipient->status" /></a>
        @empty<div class="p-5"><x-empty-state message="Belum ada penerima yang ditetapkan." /></div>@endforelse
    </div>
</div>
@endsection

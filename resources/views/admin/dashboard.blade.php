@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('content')
<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
    <x-stat-card label="Total Warga" :value="$stats['warga']" hint="Seluruh data warga terdaftar" />
    <x-stat-card label="Menunggu Verifikasi" :value="$stats['menunggu']" hint="Pending dan sudah ditugaskan" />
    <x-stat-card label="Warga Terverifikasi" :value="$stats['terverifikasi']" hint="Sudah melalui survei lapangan" />
    <x-stat-card label="Penerima Ditetapkan" :value="$stats['penerima']" hint="Pada seluruh program bantuan" />
    <x-stat-card label="Program Aktif" :value="$stats['programAktif']" />
    <x-stat-card label="Petugas Sistem" :value="$stats['petugas']" hint="RT/RW, surveyor, dan penyalur" />
</div>
<div class="mt-8 rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 p-5">
        <div><h2 class="font-bold text-slate-900">Aktivitas Verifikasi Terbaru</h2><p class="mt-1 text-sm text-slate-500">Lima aktivitas survei terakhir.</p></div>
        <a href="{{ route('admin.verifications.index') }}" class="text-sm font-semibold text-emerald-700">Lihat semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-500"><tr><th class="px-5 py-3">Warga</th><th class="px-5 py-3">Wilayah</th><th class="px-5 py-3">Surveyor</th><th class="px-5 py-3">Skor</th><th class="px-5 py-3">Status</th></tr></thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($latestSurveys as $survey)
                <tr><td class="px-5 py-4 font-medium">{{ $survey->citizen->name }}</td><td class="px-5 py-4">{{ $survey->citizen->wilayah }}</td><td class="px-5 py-4">{{ $survey->surveyor->name }}</td><td class="px-5 py-4 font-bold">{{ $survey->priority_score ?? '—' }}</td><td class="px-5 py-4"><x-status-badge :status="$survey->status" /></td></tr>
            @empty<tr><td colspan="5" class="px-5 py-10 text-center text-slate-500">Belum ada data survei.</td></tr>@endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

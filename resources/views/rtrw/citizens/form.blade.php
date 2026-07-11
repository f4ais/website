@extends('layouts.app')
@section('title', $citizen->exists ? 'Edit Warga' : 'Input Warga')
@section('page-title', $citizen->exists ? 'Edit Data Warga' : 'Input Data Warga')
@section('content')
<div class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-800">Data otomatis tercatat pada wilayah <strong>{{ auth()->user()->wilayah }}</strong>.</div>
<form action="{{ $citizen->exists ? route('rtrw.citizens.update',$citizen) : route('rtrw.citizens.store') }}" method="POST" class="max-w-5xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">@csrf @if($citizen->exists) @method('PUT') @endif
@include('partials.citizen-form',['showWilayah'=>false])
<div class="mt-7 flex gap-3"><button class="rounded-xl bg-emerald-800 px-5 py-3 font-semibold text-white">Simpan</button><a href="{{ route('rtrw.citizens.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold">Batal</a></div>
</form>
@endsection

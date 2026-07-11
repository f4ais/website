@extends('layouts.app')
@section('title', $citizen->exists ? 'Edit Warga' : 'Tambah Warga')
@section('page-title', $citizen->exists ? 'Edit Data Warga' : 'Tambah Data Warga')
@section('content')
<form action="{{ $citizen->exists ? route('admin.citizens.update',$citizen) : route('admin.citizens.store') }}" method="POST" class="max-w-5xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">@csrf @if($citizen->exists) @method('PUT') @endif
@include('partials.citizen-form',['showWilayah'=>true])
<div class="mt-7 flex gap-3"><button class="rounded-xl bg-emerald-800 px-5 py-3 font-semibold text-white">Simpan</button><a href="{{ route('admin.citizens.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold">Batal</a></div>
</form>
@endsection

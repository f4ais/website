@extends('layouts.app')
@section('title', $user->exists ? 'Edit Akun' : 'Tambah Akun')
@section('page-title', $user->exists ? 'Edit Akun' : 'Tambah Akun')
@section('content')
<form action="{{ $user->exists ? route('admin.users.update',$user) : route('admin.users.store') }}" method="POST" class="max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">@csrf @if($user->exists) @method('PUT') @endif
<div class="grid gap-5 sm:grid-cols-2">
<div><label class="mb-2 block text-sm font-semibold">Nama lengkap</label><input name="name" value="{{ old('name',$user->name) }}" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
<div><label class="mb-2 block text-sm font-semibold">Email</label><input type="email" name="email" value="{{ old('email',$user->email) }}" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
<div><label class="mb-2 block text-sm font-semibold">Peran</label><select name="role" required class="w-full rounded-xl border border-slate-300 px-4 py-3"><option value="">Pilih peran</option>@foreach(['admin'=>'Admin','rtrw'=>'RT/RW','surveyor'=>'Surveyor','penyalur'=>'Penyalur'] as $value=>$label)<option value="{{ $value }}" @selected(old('role',$user->role)===$value)>{{ $label }}</option>@endforeach</select></div>
<div><label class="mb-2 block text-sm font-semibold">Wilayah RT/RW</label><input name="wilayah" value="{{ old('wilayah',$user->wilayah) }}" placeholder="Contoh: RT 001 / RW 002" class="w-full rounded-xl border border-slate-300 px-4 py-3"><p class="mt-1 text-xs text-slate-500">Wajib untuk akun RT/RW.</p></div>
<div><label class="mb-2 block text-sm font-semibold">Password {{ $user->exists ? '(opsional)' : '' }}</label><input type="password" name="password" {{ $user->exists ? '' : 'required' }} class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
<div><label class="mb-2 block text-sm font-semibold">Konfirmasi password</label><input type="password" name="password_confirmation" class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
<div><label class="mb-2 block text-sm font-semibold">Status akun</label><select name="is_active" class="w-full rounded-xl border border-slate-300 px-4 py-3"><option value="1" @selected(old('is_active',$user->is_active ?? 1)==1)>Aktif</option><option value="0" @selected(old('is_active',$user->is_active ?? 1)==0)>Nonaktif</option></select></div>
</div>
<div class="mt-7 flex gap-3"><button class="rounded-xl bg-emerald-800 px-5 py-3 font-semibold text-white">Simpan</button><a href="{{ route('admin.users.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold">Batal</a></div>
</form>
@endsection

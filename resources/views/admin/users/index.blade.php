@extends('layouts.app')
@section('title', 'Kelola Akun')
@section('page-title', 'Kelola Akun Pengguna')
@section('content')
<div class="mb-5 flex flex-wrap items-center justify-between gap-3"><div><h2 class="text-xl font-bold">Akun Sistem</h2><p class="text-sm text-slate-500">Kelola akun RT/RW, surveyor, penyalur, dan admin.</p></div><a href="{{ route('admin.users.create') }}" class="rounded-xl bg-emerald-800 px-4 py-2.5 text-sm font-semibold text-white">Tambah Akun</a></div>
<form class="mb-5 grid gap-3 rounded-2xl border border-slate-200 bg-white p-4 sm:grid-cols-[1fr_180px_auto]">
    <input name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="rounded-xl border border-slate-300 px-4 py-2.5">
    <select name="role" class="rounded-xl border border-slate-300 px-4 py-2.5"><option value="">Semua peran</option>@foreach(['admin'=>'Admin','rtrw'=>'RT/RW','surveyor'=>'Surveyor','penyalur'=>'Penyalur'] as $value=>$label)<option value="{{ $value }}" @selected(request('role')===$value)>{{ $label }}</option>@endforeach</select>
    <button class="rounded-xl border border-slate-300 px-4 py-2.5 font-semibold">Filter</button>
</form>
<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"><div class="overflow-x-auto"><table class="min-w-full text-sm"><thead class="bg-slate-50 text-left text-xs uppercase text-slate-500"><tr><th class="px-5 py-3">Nama</th><th class="px-5 py-3">Peran</th><th class="px-5 py-3">Wilayah</th><th class="px-5 py-3">Status</th><th class="px-5 py-3 text-right">Aksi</th></tr></thead><tbody class="divide-y divide-slate-100">
@forelse($users as $user)<tr><td class="px-5 py-4"><p class="font-semibold">{{ $user->name }}</p><p class="text-xs text-slate-500">{{ $user->email }}</p></td><td class="px-5 py-4 uppercase">{{ $user->role }}</td><td class="px-5 py-4">{{ $user->wilayah ?? '—' }}</td><td class="px-5 py-4"><x-status-badge :status="$user->is_active ? 'active' : 'closed'" /></td><td class="px-5 py-4"><div class="flex justify-end gap-2"><a href="{{ route('admin.users.edit',$user) }}" class="rounded-lg border border-slate-300 px-3 py-2">Edit</a>@if(!$user->is(auth()->user()))<form action="{{ route('admin.users.destroy',$user) }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">@csrf @method('DELETE')<button class="rounded-lg border border-rose-200 px-3 py-2 text-rose-700">Hapus</button></form>@endif</div></td></tr>@empty<tr><td colspan="5" class="px-5 py-10 text-center text-slate-500">Data akun tidak ditemukan.</td></tr>@endforelse
</tbody></table></div></div><div class="mt-5">{{ $users->links() }}</div>
@endsection

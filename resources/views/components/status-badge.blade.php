@props(['status'])
@php
    $classes = match ($status) {
        'verified', 'tersalurkan', 'active' => 'bg-emerald-100 text-emerald-800',
        'assigned', 'diproses', 'ditetapkan' => 'bg-amber-100 text-amber-800',
        'rejected', 'gagal', 'closed' => 'bg-rose-100 text-rose-800',
        default => 'bg-slate-100 text-slate-700',
    };
    $label = str_replace('_', ' ', $status);
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold capitalize '.$classes]) }}>{{ $label }}</span>

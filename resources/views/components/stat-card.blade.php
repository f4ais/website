@props(['label', 'value', 'hint' => null])
<div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
    <p class="text-sm font-medium text-slate-500">{{ $label }}</p>
    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $value }}</p>
    @if($hint)<p class="mt-2 text-xs text-slate-500">{{ $hint }}</p>@endif
</div>

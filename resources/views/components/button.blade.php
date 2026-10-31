@props(['variant' => 'primary', 'type' => 'button'])
@php
    $v = [
        'primary' => 'bg-brand text-white',
        'soft' => 'bg-brand-second text-brand',
        'ghost' => 'bg-white text-ink border border-mute',
        'dark' => 'bg-[#303030] text-white',
        'off' => 'bg-brand-second/50 text-brand/40 pointer-events-none',
    ][$variant];
    $cls =
        'inline-flex h-10 items-center justify-center rounded-lg px-5 font-display text-sm font-semibold disabled:pointer-events-none disabled:opacity-60';
@endphp
@if ($attributes->has('href'))
    <a {{ $attributes->class([$cls, $v]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->class([$cls, $v]) }}>{{ $slot }}</button>
@endif

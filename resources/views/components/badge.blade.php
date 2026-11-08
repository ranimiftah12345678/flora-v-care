@props([
    'tone' => 'neutral',
])

@php
    $tones = [
        'neutral' => 'bg-rose-soft text-ink',
        'success' => 'bg-[#e7f6ec] text-[#1d6b3f]',
        'warning' => 'bg-[#fdf3e0] text-[#8a5a00]',
        'danger' => 'bg-[#fde4e8] text-wine',
        'info' => 'bg-rose-soft text-ink',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex w-fit items-center rounded-full px-2.5 py-1 text-[10px] font-semibold ' . $tones[$tone]]) }}>
    {{ $slot }}
</span>

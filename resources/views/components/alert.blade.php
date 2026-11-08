@props([
    'type' => 'info',
    'title' => null,
    'message' => null,
])

@php
    $alertClass = [
        'info' => 'border-rose-soft bg-rose-soft text-ink',
        'success' => 'border-[#bfe6cd] bg-[#e7f6ec] text-ink',
        'warning' => 'border-[#f5dfae] bg-[#fdf3e0] text-ink',
        'danger' => 'border-rose-soft bg-rose-soft text-wine',
    ][$type] ?? 'border-rose-soft bg-rose-soft text-ink';
@endphp

<div {{ $attributes->merge(['class' => 'policy-alert ' . $alertClass]) }}>
    @if ($title !== null)
        <strong>{{ $title }}</strong>
    @endif
    @if ($message !== null)
        <p>{{ $message }}</p>
    @endif
</div>

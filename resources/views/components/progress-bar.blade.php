@props([
    'value' => 0,
    'max' => 100,
])

@php
    $percent = $max > 0 ? (int) round(($value / $max) * 100) : 0;
@endphp

<div {{ $attributes->merge(['class' => 'h-2 w-full overflow-hidden rounded-full bg-rose-soft', 'role' => 'progressbar', 'aria-valuemin' => '0', 'aria-valuemax' => (string) $max, 'aria-valuenow' => (string) $value]) }}>
    <div class="h-full rounded-full bg-[#a20e49]" style="width: {{ $percent }}%"></div>
</div>

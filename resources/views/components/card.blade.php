@props([
    'variant' => 'student',
    'eyebrow' => null,
    'title' => null,
])

@php
    $classes = [
        'student' => 'student-card',
        'admin' => 'admin-panel',
        'plain' => 'rounded-[14px] border border-rose-card bg-white p-5 shadow-[0_6px_18px_rgba(96,23,45,0.035)]',
    ][$variant] ?? 'student-card';
@endphp

<section {{ $attributes->merge(['class' => $classes]) }}>
    @if ($title !== null)
        <header class="{{ $variant === 'admin' ? 'admin-panel-heading' : 'student-section-heading' }}">
            @if ($eyebrow !== null)
                <span class="{{ $variant === 'admin' ? 'admin-chip' : 'student-eyebrow' }}">{{ $eyebrow }}</span>
            @endif
            <h2>{{ $title }}</h2>
        </header>
    @endif

    {{ $slot }}
</section>

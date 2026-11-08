@props([
    'title' => 'Penting',
    'message' => null,
])

<div {{ $attributes->merge(['class' => 'policy-alert']) }}>
    <strong>{{ $title }}</strong>
    @if ($message !== null)
        <p>{{ $message }}</p>
    @endif
</div>

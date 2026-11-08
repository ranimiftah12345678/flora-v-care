@props([
    'name' => 'likert',
    'value' => null,
    'labels' => [],
])

<div {{ $attributes->merge(['class' => 'grid w-full gap-2', 'role' => 'radiogroup', 'aria-label' => 'Penilaian sikap']) }}>
    @foreach ($labels as $index => $label)
        <label class="flex items-center gap-2">
            <input type="radio" name="{{ $name }}" value="{{ $index }}" @checked($value != null && (int) $value === (int) $index) class="accent-[#a20e49]" />
            <span class="text-[10px] text-ink">{{ $label }}</span>
        </label>
    @endforeach
</div>

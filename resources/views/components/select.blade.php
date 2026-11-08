@props([
    'name' => null,
    'options' => [],
])

<select name="{{ $name }}" {{ $attributes->merge(['class' => 'w-full rounded-[7px] border border-rose-card bg-rose-card px-3 py-2 font-sans text-[10px] text-ink']) }}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>

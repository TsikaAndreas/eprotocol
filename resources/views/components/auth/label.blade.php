@props(['value'])

<label {{ $attributes->merge(['class' => 'text-sm font-semibold px-1']) }}>
    {{ $value ?? $slot }}
</label>

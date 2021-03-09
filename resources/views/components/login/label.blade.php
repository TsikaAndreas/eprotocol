@props(['value'])

<label {{ $attributes->merge(['class' => 'flex items-center bg-transparent block w-full']) }}>
    {{ $value ?? $slot }}
</label>

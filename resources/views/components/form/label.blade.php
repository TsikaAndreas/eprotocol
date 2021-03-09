@props(['value'])

<label {{ $attributes->merge(['class' => 'block capitalize tracking-wide text-grey-darker text-sm font-bold mb-2 w-1/4']) }}>
    {{ $value ?? $slot }}
</label>

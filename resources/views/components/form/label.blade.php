@props(['value'])

<label {{ $attributes->merge(['class' => 'block capitalize tracking-wide text-grey-darker text-md mb-2']) }}>
    {{ $value ?? $slot }}
</label>

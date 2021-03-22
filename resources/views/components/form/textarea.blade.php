@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'mt-2 mb-2 appearance-none block w-full h-24 bg-grey-lighter text-grey-darker border border-red rounded'
    ]) !!}> {{ $value ?? $slot }}</textarea>

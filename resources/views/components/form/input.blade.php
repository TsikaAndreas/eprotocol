@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded'
    ]) !!}>

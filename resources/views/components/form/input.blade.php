@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'mt-2 mb-2 appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded'
    ]) !!} autofocus autocomplete="off">

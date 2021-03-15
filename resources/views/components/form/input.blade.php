@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'mt-2 mb-3 appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded'
    ]) !!} autofocus autocomplete="off">

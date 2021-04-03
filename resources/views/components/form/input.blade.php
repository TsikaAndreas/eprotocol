@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'mt-2 mb-2 appearance-none block w-full border border-red-600 rounded'
    ]) !!} autofocus autocomplete="off">

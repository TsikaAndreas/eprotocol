@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'custom-input'
    ]) !!} autofocus autocomplete="off">

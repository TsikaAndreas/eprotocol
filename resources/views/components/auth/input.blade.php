@props(['disabled' => false, 'value' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'guest-input'
    ]) !!} value="{{$value}}">

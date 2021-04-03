@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'custom-textarea'
    ]) !!}>{{ $value ?? $slot }}</textarea>

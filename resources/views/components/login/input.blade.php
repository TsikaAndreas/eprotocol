@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'text-white rounded-md border-none focus:border-transparent
     placeholder-white focus:placeholder-transparent
     bg-transparent focus:bg-transparent active:bg-transparent'
    ]) !!}>

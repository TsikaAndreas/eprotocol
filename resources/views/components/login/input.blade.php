@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'text-custom-indigo rounded-md border-none bg-white focus:border-transparent
     placeholder-custom-indigo focus:placeholder-transparent
     bg-transparent focus:bg-white active:bg-white'
    ]) !!}>

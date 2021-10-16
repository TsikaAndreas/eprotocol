@props(['disabled' => false, 'value' => '', 'error'])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'guest-input'
    ]) !!} value="{{$value}}">
@error($error) <span class="error">{{ $message }}</span> @enderror

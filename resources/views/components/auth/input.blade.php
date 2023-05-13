@props(['disabled' => false, 'value' => '', 'error'])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'guest-input'
    ]) !!} value="{{$value}}">
@if($attributes['type'] === 'password')
    <i class="far fa-eye-slash active-eye cursor-pointer"></i>
@endif
@error($error) <span class="error">{{ $message }}</span> @enderror

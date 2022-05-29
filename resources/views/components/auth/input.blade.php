@props(['disabled' => false, 'value' => '', 'error'])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'guest-input'
    ]) !!} value="{{$value}}">
<i class="far fa-eye-slash active-eye cursor-pointer"></i>
@error($error) <span class="error">{{ $message }}</span> @enderror

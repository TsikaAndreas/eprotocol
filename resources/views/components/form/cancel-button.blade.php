<a id="cancel_button" href="{{route('dashboard')}}" {{ $attributes->merge(['type' => 'button', 'name' => 'cancel',
'class' => 'cancel-button']) }}>
    {{ $slot }}
</a>

{{--<button id="cancel_button" {{ $attributes->merge(['type' => 'submit', 'name' => 'cancel',--}}
{{--'class' => 'bg-white border border-black hover:bg-gray-200 text-black py-2 px-3']) }}>--}}
{{--    {{ $slot }}--}}
{{--</button>--}}

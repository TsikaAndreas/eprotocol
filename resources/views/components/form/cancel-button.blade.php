<a id="cancel_button" href="{{route('dashboard')}}" {{ $attributes->merge(['type' => 'button', 'name' => 'cancel',
'class' => 'cancel-button']) }}>
    {{ $slot }}
</a>

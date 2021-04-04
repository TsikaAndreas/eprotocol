<button {{ $attributes->merge(['type' => 'submit', 'name' => 'submit',
'class' => 'submit-button']) }}>
    {{ $slot }}
</button>

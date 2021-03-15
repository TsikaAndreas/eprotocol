<button {{ $attributes->merge(['type' => 'submit', 'name' => 'submit',
'class' => 'bg-green-500 border border-green-500 hover:bg-green-600 text-white py-2 px-3']) }}>
    {{ $slot }}
</button>

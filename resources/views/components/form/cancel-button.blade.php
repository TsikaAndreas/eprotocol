<button {{ $attributes->merge(['type' => 'submit', 'name' => 'submit',
'class' => 'bg-white border border-black hover:bg-gray-200 text-black py-2 px-3']) }}>
    {{ $slot }}
</button>

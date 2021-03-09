<button {{ $attributes->merge(['type' => '', 'class' => 'flex
    text-md font-semibold text-gray-600 px-6 py-3 mb-5 rounded-full
    bg-gradient-to-b from-white to-white hover:text-white hover:from-custom-purple hover:to-custom-indigo
    ']) }}>
    {{ $slot }}
</button>

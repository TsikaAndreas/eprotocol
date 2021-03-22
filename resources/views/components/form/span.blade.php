<span {!! $attributes->merge([
    'class' => 'flex flex-col mt-2 p-2 border border-bg-gray-100 bg-gray-100'
    ]) !!}>
    {{ $value ?? $slot }}
</span>

@props(['errors'])

@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'px-3 mb-4']) }}>
        <div class="font-medium text-red-600">
            {{ __('auth.validation_error_message') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

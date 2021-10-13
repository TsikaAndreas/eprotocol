<x-app-layout>
    <x-layouts.page-header :title="$title">
        <i class="fas fa-file-signature fa-2x header-icon"></i>
    </x-layouts.page-header>
    <div class="breadcrumb mx-4">
        @if(isset($preview_mode) && $preview_mode === 'PREVIEW')
            {{ Breadcrumbs::render('show-protocol', $protocol) }}
        @elseif(isset($preview_mode) && $preview_mode === 'EDIT')
            {{ Breadcrumbs::render('edit-protocol', $protocol) }}
        @else
            {{ Breadcrumbs::render('new-protocol', $type) }}
        @endif
    </div>
    <div class="pb-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            @if(isset($preview_mode) && $preview_mode === 'PREVIEW')
                <x-protocol.show :protocol="$protocol" :preview="$preview_mode" :files="$files"></x-protocol.show>
            @elseif(isset($preview_mode) && $preview_mode === 'EDIT')
                <x-protocol.edit :protocol="$protocol" :preview="$preview_mode" :files="$files"></x-protocol.edit>
            @else
                <x-protocol.create :type="$type" :preview="$preview_mode"></x-protocol.create>
            @endif
        </div>
    </div>
    @push('footer-scripts')
        <script type="text/javascript" src="{{ asset('js/protocol/protocol-bundle.js') }}"></script>
    @endpush
</x-app-layout>

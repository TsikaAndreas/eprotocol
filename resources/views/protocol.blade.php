<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3md mx-auto sm:px-6 lg:px-8">
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
        <script type="text/javascript" src="{{ asset('js/protocol/protocol-actions.js') }}"></script>
    @endpush
</x-app-layout>

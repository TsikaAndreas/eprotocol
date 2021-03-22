<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3md mx-auto sm:px-6 lg:px-8">
            @if(isset($preview_mode) && $preview_mode == 'PREVIEW')
                <x-protocol.show :protocol="$protocol" :preview="$preview_mode"></x-protocol.show>
            @else
                <x-protocol.create :type="$type"></x-protocol.create>
            @endif
        </div>
    </div>
</x-app-layout>

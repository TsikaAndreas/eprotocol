<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3 mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-x-12">
            @asyncWidget('latestProtocols')
        </div>
    </div>
</x-app-layout>

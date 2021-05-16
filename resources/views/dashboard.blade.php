@push('head-scripts')
    <script src="{{ asset('js/chart.js/chart.min.js') }}"></script>
@endpush

<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-2 grid row-cols-2 gap-y-16 mx-4 mt-4">
        <div class="grid grid-cols-2 gap-x-12">
            <div>
                @asyncWidget('piechart')
            </div>
            <div>
                @asyncWidget('latestProtocols')
            </div>
        </div>
    </div>
</x-app-layout>

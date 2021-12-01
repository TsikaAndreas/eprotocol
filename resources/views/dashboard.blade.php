@push('head-scripts')
    <script src="{{ asset('js/chart.js/chart.min.js') }}"></script>
@endpush

<x-app-layout>
    <x-layouts.page-header :title="$title">
        <i class="fas fa-home fa-2x header-icon"></i>
    </x-layouts.page-header>

    <x-alerts.success :data="session('success')"></x-alerts.success>

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
    <div class="py-2 grid row-cols-1 gap-y-16 mx-4 mt-4 mb-8">
        <div class="grid grid-cols-1">
            <div>
                @asyncWidget('latestActivity')
            </div>
        </div>
    </div>
</x-app-layout>

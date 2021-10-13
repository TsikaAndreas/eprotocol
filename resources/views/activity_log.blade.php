<x-app-layout>
    <x-layouts.page-header :title="$title">
        <i class="fas fa-database fa-2x header-icon"></i>
    </x-layouts.page-header>
    <div class="breadcrumb">
        {{ Breadcrumbs::render('activity-log') }}
    </div>
    <div class="py-4">
        <div class="page-container">
            <x-datatables.index id="activity-log"
                                :columns="$columns"
                                :lang="$lang_file"
                                :url="$url"
            ></x-datatables.index>
        </div>
    </div>
</x-app-layout>

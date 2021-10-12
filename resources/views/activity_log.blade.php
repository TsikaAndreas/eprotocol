<x-app-layout>
    <x-layouts.page-header :title="$title">
        <i class="fas fa-database fa-2x header-icon"></i>
    </x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-6">
                <x-datatables.index id="activity-log"
                                    :columns="$columns"
                                    :lang="$lang_file"
                                    :url="$url"
                ></x-datatables.index>
            </div>
        </div>
    </div>
</x-app-layout>

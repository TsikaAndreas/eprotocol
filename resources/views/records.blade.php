<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-6">

                <table class="table table-bordered" id="records-table">
                    <thead>
                    <tr>
                        <th>{{-- Add header--}}</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>

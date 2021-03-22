@php
$protocol_count = \App\Models\Protocol::get()->count();
$protocol_active = \App\Models\Protocol::where('status', 'Active')->get()->count();
$protocol_ingoing = \App\Models\Protocol::where('type', 'ingoing')->get()->count();
$protocol_outgoing = \App\Models\Protocol::where('type', 'outgoing')->get()->count();

@endphp

<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3 mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-x-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="card">
                    <div class="card-header bg-indigo-700">
                        <h4 class="card-title text-white">Στατιστικά Πρωτοκόλλων </h4>
                        <div class="heading-elements">
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="border-top-0">Σύνολο Πρωτοκόλλων</th>
                                        <td class="border-top-0 text-right">{{$protocol_count}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Ενεργά Πρωτοκόλλα</th>
                                        <td class="text-right">{{$protocol_active}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Εισερχόμενα Πρωτοκόλλα</th>
                                        <td class="text-right">{{$protocol_ingoing}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Εξερχόμενα Πρωτοκόλλα</th>
                                        <td class="text-right">{{$protocol_outgoing}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

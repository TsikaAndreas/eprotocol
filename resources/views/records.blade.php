
@push('head-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
{{--            <link rel="stylesheet" type="text/css" href="{{asset('external/DataTables/datatables.min.css')}}"/>--}}
@endpush
@push('footer-scripts')
{{--        <script type="text/javascript" src="{{asset('external/DataTables/datatables.min.js')}}"></script>--}}
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
@endpush
<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-6">

                <table class="table table-bordered" id="protocols-table">
                    <thead>
                    <tr>
                        <th>Protocol</th>
                        <th>Protocol Date</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Creator</th>
                        <th>Receiver</th>
                        <th>Created At</th>
                        {{--<th>Updated At</th>--}}
                        <th>Canceled At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('#protocols-table').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                ajax: '{!! route('records.getRecords') !!}',
                columns: [
                    { data: 'protocol', name: 'protocol' },
                    { data: 'protocol_date', name: 'protocol_date' },
                    { data: 'status', name: 'status' },
                    { data: 'type', name: 'type' },
                    { data: 'creator', name: 'creator' },
                    { data: 'receiver', name: 'receiver' },
                    { data: 'created_at', name: 'created_at' },
                    // { data: 'updated_at', name: 'updated_at' },
                    { data: 'canceled_at', name: 'canceled_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
</x-app-layout>

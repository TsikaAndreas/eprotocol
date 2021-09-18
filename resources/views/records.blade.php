@push('footer-scripts')
    <script>
        const columns = @json($columns);
        $(function() {
            $('#protocols-table').DataTable({
                dom: '<"inline-block"B><lfrtip>',
                processing: true,
                serverSide: false,
                responsive: true,
                language: JSON.parse(@json($language_file)),
                ajax: '{!! route('records.getData') !!}',
                columns: columns,
                buttons: [
                    {
                        extend: 'collection',
                        text: 'Export Options',
                        className: 'custom-html-collection',
                        collectionLayout: 'fixed',
                        autoClose: true,
                        buttons: [
                            {
                                extend: 'excel',
                                text: 'Excel',
                                header: true,
                                filename: "Records_" + Date.now(),
                                title: null,
                                sheetName: "Protocols",
                                exportOptions: {
                                    columns: 'th:not(.no-export)'
                                }
                            },
                            {
                                extend: 'csv',
                                text: 'CSV',
                                header: true,
                                bom: true,
                                filename: "Records_" + Date.now(),
                                exportOptions: {
                                    columns: 'th:not(.no-export)'
                                }
                            },
                            {
                                extend: 'pdf',
                                text: 'PDF',
                                header: true,
                                filename: "Records_" + Date.now(),
                                orientation: 'landscape',
                                pageSize: "A4",
                                exportOptions: {
                                    columns: 'th:not(.no-export)'
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                header: true,
                                exportOptions: {
                                    columns: 'th:not(.no-export)'
                                }
                            }
                        ]
                    },
                    {
                        extend: 'colvis',
                        collectionLayout: 'fixed two-column'
                    }
                ]
            });
            $('#protocols-table_length select').css('padding-right','1.5rem');
        });
    </script>
@endpush
<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-6">

                <table class="table table-striped- table-bordered table-hover table-checkable dataTable display nowrap" id="protocols-table" style="width: 100%;">
                    <thead>
                    <tr class="headings">
                        @foreach($columns as $column)
                           <th>{{$column['name']}}</th>
                        @endforeach
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

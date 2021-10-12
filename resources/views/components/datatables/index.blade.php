<table class="table table-striped- table-bordered table-hover table-checkable dataTable display nowrap"
       id="{{$id}}-table" style="width: 100%;">
    <thead>
    <tr class="headings">
        @foreach($columns as $column)
            <th>{{$column['title']}}</th>
        @endforeach
    </tr>
    </thead>
</table>

@push('footer-scripts')
    <script>
        const columns = @json($columns);
        $(function() {
            $('#{{$id}}-table').DataTable({
                dom: '<"inline-block"B><lfrtip>',
                processing: true,
                serverSide: true,
                responsive: true,
                language: JSON.parse(@json($lang)),
                ajax: '{{$url}}',
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
                                filename: "{{$id}}_" + Date.now(),
                                title: null,
                                sheetName: "{{$id}}",
                                exportOptions: {
                                    columns: 'th:not(.no-export)'
                                }
                            },
                            {
                                extend: 'csv',
                                text: 'CSV',
                                header: true,
                                bom: true,
                                filename: "{{$id}}_" + Date.now(),
                                exportOptions: {
                                    columns: 'th:not(.no-export)'
                                }
                            },
                            {
                                extend: 'pdf',
                                text: 'PDF',
                                header: true,
                                filename: "{{$id}}_" + Date.now(),
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
            $('#{{$id}}-table_length select').css('padding-right','1.5rem');
        });
    </script>
@endpush

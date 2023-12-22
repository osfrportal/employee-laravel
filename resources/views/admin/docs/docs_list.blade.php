@extends('osfrportal::layout')
@section('content')
    <a class="btn btn-primary" href="{{ route('osfrportal.admin.docs.add') }}" role="button">Добавить</a>
    <hr>
    <table class="table border-top table-responsive" id="table-docs">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Ознакомление</th>
                <th>Группа документов</th>
                <th>Номер</th>
                <th>Дата</th>
                <th>Наименование</th>
                <th>Описание</th>
                <th>Количество файлов</th>
            </tr>
        </thead>
    </table>
@endsection
@push('footer-scripts')
    <?php
    $route_api_docs_all = route('osfrapi.osfrportal.admin.docs.all');
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-docs').DataTable({
                ajax: '{{ route('osfrapi.osfrportal.admin.docs.all') }}',

                columns: [{
                        data: 'docId'
                    },
                    {
                        data: 'docNeedSign'
                    },
                    {
                        data: 'docGroup'
                    },
                    {
                        data: 'docNumber'
                    },
                    {
                        data: 'docDate'
                    },
                    {
                        data: 'docName'
                    },
                    {
                        data: 'docDescription'
                    },
                    {
                        data: 'docFileCount'
                    },
                ],
                columnDefs: [{
                        className: "dt-center",
                        targets: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    {
                        // Actions
                        targets: 0,
                        title: 'Действия',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {

                            var url = '{{ route('osfrportal.admin.docs.detail', ':slug') }}';
                            url = url.replace(':slug', data);

                            var linkView = "#";
                            return (
                                '<a href="' + url +
                                '"><i class="ti ti-vocabulary"></i></a>'
                            );
                        }
                    },
                    {
                        // Actions
                        targets: 1,
                        title: 'Ознакомление',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            if (data === true) {
                                return '<h6 class="bi bi-check-lg"></h6>';
                            } else {
                                return '<h6 class="bi bi-dash-lg"></h6>';
                            }
                        }
                    },
                    {
                        // Actions
                        targets: 2,
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            var docsTypes = JSON.parse({{ Js::from($groupsShort) ?? '' }});
                            return docsTypes[data];
                        }
                    },
                    {
                        // Actions
                        targets: 4,
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            return data.slice(0, 10).split('-').reverse().join('.')
                        }
                    },
                ],
            });
        });
    </script>
@endpush

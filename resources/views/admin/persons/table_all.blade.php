@extends('osfrportal::layout')
@section('content')
    <div class="pt-0">
        <table class="table table-striped table-sm dataTable no-footer " id="table-persons">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Таб. #</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Должность</th>
                    <th>Поразделение</th>
                    <th>Активность на портале</th>
                    <th>Отпуск</th>
                    <th>Дата начала работы</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <?php
    $route_api_persons_all = route('osfrapi.osfrportal.admin.persons.show.all');
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-persons').DataTable({
                ajax: '{{ $route_api_persons_all }}',
                dom: '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
                ordering: true,
                serverSide: true,
                processing: true,
                order: [
                    [2, 'asc'],
                    [3, 'asc']
                ],
                columns: [{
                        data: 'pid',
                        orderable: false,
                        searchable: false,
                        className: 'dt-body-center',
                        render: function(data, type, full, meta) {

                            var url = '{{ route('osfrportal.admin.persons.detail', ':slug') }}';
                            url = url.replace(':slug', data);

                            var linkView = "#";
                            return (
                                '<a href="' + url +
                                '"><i class="bi bi-person-circle"></i></a>'
                            );
                        }
                    },
                    {
                        data: 'persondata_tabnum',
                        className: 'dt-center',
                    },
                    {
                        data: 'psurname',
                        orderable: true,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        data: 'pname',
                        orderable: false,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        data: 'pmiddlename',
                        orderable: false,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        data: 'persondata_appointment',
                        targets: 5,
                        orderable: true,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        data: 'persondata_unit_name',
                        targets: 5,
                        orderable: true,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        data: 'persondata_lastactivity',
                        orderable: true,
                        searchable: false,
                        className: 'dt-left',
                    },
                    {
                        data: 'persondata_vacation',
                        orderable: false,
                        searchable: false,
                        className: 'dt-left',
                    },
                    {
                        data: 'pworkstart',
                        orderable: false,
                        searchable: false,
                        className: 'dt-left',
                    },
                ],
            });
        });
    </script>
@endpush

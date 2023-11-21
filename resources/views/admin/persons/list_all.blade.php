@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item active">Управление работниками</li>
            </ol>
        </nav>
    </div>
@endsection
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
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <?php
    $route_api_persons_all = route('osfrapi.osfrportal.admin.persons.all');
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-persons').DataTable({
                ajax: '{{ $route_api_persons_all }}',
                ordering: true,
                order: [
                    [2, 'asc'],
                    [3, 'asc']
                ],
                columns: [{
                        data: 'persondata_pid'
                    },
                    {
                        data: 'persondata_tabnum'
                    },
                    {
                        data: 'persondata_psurname'
                    },
                    {
                        data: 'persondata_pname'
                    },
                    {
                        data: 'persondata_pmiddlename'
                    },
                    {
                        data: 'persondata_appointment'
                    },
                    {
                        data: 'persondata_unit_name'
                    },
                    {
                        data: 'persondata_lastactivity'
                    },
                    {
                        data: 'persondata_vacation'
                    },
                ],
                columnDefs: [{
                        // Actions
                        targets: 0,
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
                        targets: 1,
                        className: 'dt-center',
                    },
                    {
                        targets: 2,
                        orderable: true,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        targets: 3,
                        orderable: false,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        targets: 4,
                        orderable: false,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        targets: 5,
                        orderable: true,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        targets: 6,
                        orderable: true,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        targets: 7,
                        orderable: true,
                        searchable: false,
                        className: 'dt-left',
                    },
                    {
                        targets: 8,
                        orderable: false,
                        searchable: false,
                        className: 'dt-left',
                    }
                ],
            });
        });
    </script>
@endpush

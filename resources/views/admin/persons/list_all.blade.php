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
        <table class="table border-top table-responsive" id="table-persons">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Таб. #</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Должность</th>
                    <th>Поразделение</th>
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

                columns: [{
                        data: 'pid'
                    },
                    {
                        data: 'psurname'
                    },
                    {
                        data: 'psurname'
                    },
                    {
                        data: 'pname'
                    },
                    {
                        data: 'pmiddlename'
                    },
                    {
                        data: 'pmiddlename'
                    },
                    {
                        data: 'pmiddlename'
                    },
                    {
                        data: 'pmiddlename'
                    },
                ],
                columnDefs: [{
                        targets: -4,
                        title: 'Создано',
                        render: DataTable.render.datetime(),
                    },

                    {
                        targets: -3,
                        title: 'Обновлено',
                        render: DataTable.render.datetime(),
                    },
                    {
                        targets: -2,
                        title: 'Полномочия',
                        render: function(data, type, full, meta) {
                            var out = '';
                            Object.entries(data).forEach(([key, value]) => {
                                var link = '<a href="{{ $route_api_persons_all }}/' + value[
                                        'id'] +
                                    '" title="Просмотр полномочия">' + value['name'] +
                                    '</a><br>';
                                out = out + link;
                            });
                            return out;
                        },

                    },
                    {
                        // Actions
                        targets: 0,
                        title: 'Действия',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {

                            var link_edit = '{{ $route_api_persons_all }}' + '/' + data;
                            var link_delete = '{{ $route_api_persons_all }}' + '/' + data;
                            var link_users = '{{ $route_api_persons_all }}' + '/' + data;
                            return (
                                '<div class="d-inline-block">' +
                                '<a href="#" class="btn btn-sm text-primary btn-icon hide-arrow" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>' +
                                '<ul class="dropdown-menu dropdown-menu-lg-end">' +
                                '<li><a href="' + link_users +
                                '" class="dropdown-item">Пользователи</a></li>' +
                                '<div class="dropdown-divider"></div>' +
                                '<li><a href="' + link_delete +
                                '" class="dropdown-item text-danger delete-record">Удалить</a></li>' +
                                '</ul>' +
                                '</div>' +
                                '<a href="' + link_edit +
                                '" class="btn btn-sm text-primary btn-icon item-edit"><i class="bi bi-pencil-square"></i></a>'
                            );
                        }
                    }
                ],
            });
        });
    </script>
@endpush

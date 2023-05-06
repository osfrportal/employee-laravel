@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Управление полномочиями портала</a></li>
                <li class="breadcrumb-item active" aria-current="page">Пользователи с полномочием <b>{{ $permissionname }}</b>
                </li>
            </ol>
        </nav>
    </div>
    @include('osfrportal::admin.permissions.role_modaladdform')
@endsection
@section('content')
    <div class="pt-0">
        <table class="table table-striped table-bordered table-sm table-responsive" id="table-permissions-users">
            <thead>
                <tr>
                    <th class="align-middle text-center">Логин</th>
                    <th class="align-middle text-center">ФИО</th>
                    <th class="align-middle text-center">Последняя активность</th>
                    <th class="align-middle text-center">Действия</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <?php
    $route_api_permission_users = route('osfrapi.osfrportal.admin.permission_users_all', $permissionid);
    $route_user_delete = '';
    ?>
    <script type="text/javascript">
        $('#table-permissions-users').DataTable({
            pagingType: 'numbers',
            ordering: false,
            serverSide: false,
            ajax: '{{ $route_api_permission_users }}',
            dataSrc: 'data',

            columns: [{
                    data: 'username'
                },
                {
                    data: 'fio'
                },
                {
                    data: 'last_activity'
                },
                {
                    data: 'pid'
                },
            ],
            columnDefs: [{
                    className: "align-middle text-center",
                    targets: [0, 1, 2, 3],
                },
                {
                    // Actions
                    targets: -1,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {

                        var link_delete = '{{ $route_user_delete }}' + '/' + data;
                        return (
                            '<a href="' + link_delete +
                            '" class="btn btn-sm text-primary btn-icon item-edit"><i class="bi bi-pencil-square"></i></a>'
                        );
                    }
                }
            ],
        });
    </script>
@endpush

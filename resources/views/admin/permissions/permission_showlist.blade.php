@extends('osfrportal::layout')
@section('dashboardTitle', 'Администрирование / Управление полномочиями портала')
@section('title2')
    @include('osfrportal::admin.permissions.permission_modaladdform')
@endsection
@section('content')
    <div class="pt-0">
        <table class="table border-top table-responsive" id="table-roles">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>guard_name</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <?php
    $route_role_edit = route('osfrportal.admin.permissions.editrole', '');
    $route_role_delete = route('osfrportal.admin.permissions.deleterole', '');
    $route_role_showusers = route('osfrportal.admin.permissions.showroleusers', '');
    $route_permission_showusers = route('osfrportal.admin.permissions.showpermissionusers', '');

    $route_api_all_permissions = route('osfrapi.osfrportal.admin.permissions_all');
    ?>
    <script type="text/javascript">
        $('#table-roles').DataTable({

            ajax: '{{ $route_api_all_permissions }}',
            dataSrc: 'data',
            columns: [{
                    data: 'name'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'updated_at'
                },
                {
                    data: 'roles'
                },
                {
                    data: 'id'
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
                    title: 'Роли',
                    render: function(data, type, full, meta) {
                        var out = '';
                        Object.entries(data).forEach(([key, value]) => {
                            var link = '<a href="{{ $route_permission_showusers }}/' + value['id'] +
                                '" title="Просмотр роли">' + value['name'] +
                                '</a><br>';
                            out = out + link;
                        });
                        return out;
                    },

                },
                {
                    // Actions
                    targets: -1,
                    title: 'Действия',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {

                        var link_edit = '{{ $route_role_edit }}' + '/' + data;
                        var link_delete = '{{ $route_role_delete }}' + '/' + data;
                        var link_users = '{{ $route_permission_showusers }}' + '/' + data;
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
    </script>
@endpush

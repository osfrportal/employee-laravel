@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Телефонный справочник</a></li>
                <li class="breadcrumb-item active">Управление адресами</li>
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
                    <th>Код города</th>
                    <th>Адрес</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <?php
    $route_api_addr_all = route('osfrapi.osfrportal.admin.phone.addresses');
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-persons').DataTable({
                ajax: '{{ $route_api_addr_all }}',

                columns: [{
                        data: 'addrid'
                    },
                    {
                        data: 'areacode'
                    },
                    {
                        data: 'paddress'
                    },
                ],
                columnDefs: [{
                    // Actions
                    targets: 0,
                    title: 'Действия',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {

                        var link_edit = '{{ $route_api_addr_all }}' + '/' + data;
                        var link_delete = '{{ $route_api_addr_all }}' + '/' + data;
                        var link_users = '{{ $route_api_addr_all }}' + '/' + data;
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
                }],
            });
        });
    </script>
@endpush

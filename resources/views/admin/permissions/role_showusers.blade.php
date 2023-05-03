@extends('osfrportal::layout')
@section('title2')
    @include('osfrportal::admin.permissions.role_modaladdform')
@endsection
@section('content')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Управление ролями портала</a></li>
                <li class="breadcrumb-item"><a href="#">Роль {{ $rolename }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Пользователи</li>
            </ol>
        </nav>
    </div>
    <div class="pt-0">
        <table class="table border-top table-responsive" id="table-roles">
            <thead>
                <tr>
                    <th>Логин</th>
                    <th>ФИО</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <?php
    $route_api_role_users = route('osfrapi.osfrportal.admin.role_users_all', $roleid);
    ?>
@endpush

@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">ИС и полномочия</a></li>
                <li class="breadcrumb-item active">Управление</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
<a class="btn btn-primary" href="{{ route('osfrportal.admin.infosystems.add') }}" role="button">Добавить ИС</a>
<a class="btn btn-primary" href="{{ route('osfrportal.admin.infosystems.roles.add') }}" role="button">Добавить полномочия (роли) ИС</a>
    <hr>
    <table class="table table-striped table-hover">
        <thead class="align-middle text-center">
            <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">Информационная система</th>
                <th scope="col">ИС data</th>
                <th scope="col">Родительская информационная система</th>
                <th scope="col">Количество полномочий (ролей)</th>
                <th scope="col">Количество работников</th>
            </tr>
        </thead>
        <tbody class="align-middle text-center">
            @foreach ($infosystems as $infosystem)
                <tr>
                    <td></td>
                    <td>{{ $infosystem->isys_name }}</td>
                    <td>{{ $infosystem->isys_data }}</td>
                    <td>{{ $infosystem->parent()->first() ? $infosystem->parent()->first()->isys_name : '-' }}</td>
                    <td>{{ $infosystem->roles()->exists() ? $infosystem->roles()->count() : '-' }}</td>
                    <td>{{ $infosystem->persons()->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

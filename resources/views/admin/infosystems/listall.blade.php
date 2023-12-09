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
    </tbody>
</table>

@endsection

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
    <a class="btn btn-primary" href="{{ route('osfrportal.admin.infosystems.roles.add') }}" role="button">Добавить
        полномочия (роли) ИС</a>
    <hr>
    <table class="table table-striped table-hover">
        <thead class="align-middle text-center">
            <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">Информационная система</th>
                <th scope="col">Количество полномочий (ролей)</th>
                <th scope="col">Количество работников</th>
            </tr>
        </thead>
        <tbody class="align-middle text-center">
            @foreach ($infosystems as $infosystem)
                <tr>
                    <td><a href="#" class="icon-link link-underline-opacity-0"><span class="ti ti-edit icon-size-24"></span></a></td>
                    <td colspan="3">{{ $infosystem->isys_name }}</td>
                </tr>
                @if ($infosystem->children->count() > 0)
                    @foreach ($infosystem->children as $infosystemChild)
                        <tr>
                            <td><a href="#"><i class="ti ti-edit icon-size-24"></i></a></td>
                            <td>{{ $infosystemChild->isys_name }}</td>
                            <td>{{ $infosystemChild->roles()->exists() ? $infosystemChild->roles()->count() : '-' }}</td>
                            <td>{{ $infosystemChild->persons()->count() }}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
@endsection

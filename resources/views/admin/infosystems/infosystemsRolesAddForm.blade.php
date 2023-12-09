@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">ИС и полномочия</a></li>
                <li class="breadcrumb-item"><a href="#">Управление</a></li>
                <li class="breadcrumb-item active">Добавление ролей для ИС</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.infosystems.roles.save') }}">

        <a class="btn btn-primary" href="{{ route('osfrportal.admin.infosystems.index') }}" role="button">Назад</a>
        <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
@endsection

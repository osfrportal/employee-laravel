@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Конфигурация портала</a></li>
                <li class="breadcrumb-item active">Основные настройки</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    @foreach ($configList as $configGoup)
        @foreach ($configGoup as $item)
            {{ $item->key }} <br>
            {{ $item->value }}<br>
            {{ $item->description }}<br>
            {{ $item->crypted }}<br>
            <hr>
        @endforeach
    @endforeach
    список настроек
@endsection

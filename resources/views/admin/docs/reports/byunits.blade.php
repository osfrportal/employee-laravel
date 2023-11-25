@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item">Управление документами</li>
                <li class="breadcrumb-item">Отчеты</li>
                <li class="breadcrumb-item active">Ознакомление по подразделениям</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    Отчет
    @include('osfrportal::admin.docs.reports.select2units')

    @foreach ($unitsCollection as $unit)
        @dump($unit);
    @endforeach
@endsection

@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item">Управление документами</li>
                <li class="breadcrumb-item active">Отчеты</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <a href="{{ route('osfrportal.admin.docs.reports.byunits') }}" title="Отчет в разрезе подразделений">Ознакомление по подразделениям</a>
@endsection
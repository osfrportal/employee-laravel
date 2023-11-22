@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item active">Статистика системы управления заявками</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    @include('osfrportal::admin.extsystems.graphs')
@endsection

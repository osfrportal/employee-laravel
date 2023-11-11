@extends('osfrportal::layout')
@section('dashboardTitle', 'Редактирование - Телефонный справочник')
@section('title', 'Редактирование - Телефонный справочник')
@section('content')
    <div class="container-fluid">
        @include('osfrportal::sections.phone.sfrphonecontactdata')
    </div>
@endsection

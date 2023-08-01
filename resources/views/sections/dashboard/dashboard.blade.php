@extends('osfrportal::layout')
@section('dashboardTitle', 'Личный кабинет')
@section('content')
    @include('osfrportal::sections.dashboard.notifications.notifications_unread')
@endsection

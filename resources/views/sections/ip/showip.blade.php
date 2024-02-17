@extends('osfrportal::layout')
@section('content')
    <h3>Ваш IP: {{ $myip ?? '' }}</h3>
@endsection

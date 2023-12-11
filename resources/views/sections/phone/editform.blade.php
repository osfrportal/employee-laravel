@extends('osfrportal::layout')
@section('breadcrumb')
    {{ Breadcrumbs::render('osfrportal.admin.persons.detail', $SFRPersonData->persondata_fullname ? $SFRPersonData->persondata_fullname : '') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('osfrportal::sections.phone.sfrphonecontactdata')
    </div>
@endsection

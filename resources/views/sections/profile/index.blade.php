@extends('osfrportal::layout')
@push('header-css')
    <link href="{{ asset('osfrportal/css/profile.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Личная информация</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">ФИО</div>
                            <div class="col">{{ $SFRPersonData->persondata_fullname }}</div>
                        </div>
                        <div class="row">
                            <div class="col">Дата рождения</div>
                            <div class="col">{{ $SFRPersonData->persondata_birthday }}</div>
                        </div>
                        <div class="row">
                            <div class="col">ИНН</div>
                            <div class="col">{{ $SFRPersonData->persondata_inn }}</div>
                        </div>
                        <div class="row">
                            <div class="col">СНИЛС</div>
                            <div class="col">{{ $SFRPersonData->persondata_snils }}</div>
                        </div>
                        <div class="row">
                            <div class="col">Табельный номер</div>
                            <div class="col">{{ $SFRPersonData->persondata_tabnum }}</div>
                        </div>
                        <div class="row">
                            <div class="col">Подразделение</div>
                            <div class="col">{{ $SFRPersonData->persondata_unit_name }}</div>
                        </div>
                        <div class="row">
                            <div class="col">Должность</div>
                            <div class="col">{{ $SFRPersonData->persondata_appointment }}</div>
                        </div>

                        <div class="small font-italic text-muted mb-4">Данные обновляются автоматически из кадровой системы
                        </div>
                    </div>
                </div>
                @include('osfrportal::sections.profile.authdata')
            </div>
            <div class="col-xl-6">
                @include('osfrportal::sections.phone.sfrphonecontactdata')
            </div>
        </div>
    </div>
@endsection

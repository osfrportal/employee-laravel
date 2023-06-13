@extends('osfrportal::layout')
@section('dashboardTitle', 'Профиль пользователя')
@push('header-css')
    <link href="{{ asset('osfrportal/css/profile.css') }}" rel="stylesheet">
@endpush
@section('title2')
    @include('osfrportal::sections.profile.profilemenu')
@endsection
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
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">Контактные данные</div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="mb-1" for="inputEmailAddress">Адрес электронной почты:</label>
                                <input class="form-control" id="inputEmailAddress" type="email"
                                    placeholder="Введите адрес электронной почты"
                                    value="{{ $SFRPhoneContactData->email_ext }}">
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="inputPhoneInt">Внутренний номер телефона:</label>
                                <input class="form-control" id="inputPhoneInt" type="tel"
                                    placeholder="Введите 4 цифры внутреннего номера телефона"
                                    value="{{ $SFRPhoneContactData->phone_internal }}" data-inputmask="'mask': '9999'">
                                <div class="font-italic text-muted mb-4">
                                    Для здания по ул. Плеханова, д.4а - указать 7000<br />
                                    Для здания г.Елец ул. Костенко д.42 - указать 8000 <br />
                                    Если номер отсутствует - указать 0000
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="inputAddr">Адрес местонахождения</label>
                                <input class="form-control form-control-lg" id="inputAddr" type="text"
                                    value="{{ $SFRPhoneContactData->address }}" disabled readonly>
                                <div class="font-italic text-muted mb-4">
                                    Адрес заполняется автоматически по внутреннему номеру телефона.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="inputRoom">Помещение:</label>
                                <input class="form-control form-control-sm" id="inputRoom" type="text"
                                    placeholder="Введите номер помещения" value="{{ $SFRPhoneContactData->room }}">
                                <div class="font-italic text-muted mb-4">
                                    В случае отсутствия номера кабинета, допускается указывать функциональное назначение
                                    помещения. Например, электрощитовая, вахта, окно приема №1 и т.д
                                </div>
                            </div>


                            <div class="mb-3">
                                <label class="mb-1" for="inputPhoneInt">Городской номер телефона:</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ $SFRPhoneContactData->areacode }}</span>
                                    <input class="form-control" id="inputPhoneInt" type="tel"
                                        placeholder="Введите городской номер телефона БЕЗ кода города"
                                        value="{{ $SFRPhoneContactData->phone_external }}"
                                        data-inputmask="'mask': '99999[9]'">
                                </div>
                                <div class="font-italic text-muted mb-4">
                                    Код города заполняется автоматически<br />
                                    Если номер отсутствует - указать 000000
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-1" for="inputPhoneMobile">Мобильный номер телефона:</label>
                                <input class="form-control" id="inputPhoneMobile" type="tel"
                                    value="{{ $SFRPhoneContactData->phone_mobile }}"
                                    data-inputmask="'mask': '+7 (999) 999-99-99'">
                            </div>


                            <button class="btn btn-primary" type="button">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

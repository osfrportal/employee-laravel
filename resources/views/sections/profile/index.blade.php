@extends('osfrportal::layout')
@section('dashboardTitle', 'Профиль пользователя')
@push('header-css')
    <link href="{{ asset('osfrportal/css/profile.css') }}" rel="stylesheet">
@endpush
@section('title2')
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="{{ route('osfrportal.profile.index') }}">Профиль</a>

        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page"
            target="__blank">Безопасность</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"
            target="__blank">Уведомления</a>
        <a class="nav-link" href="{{ route('osfrportal.profile.usbskdcerts') }}">Носители, СКУД, сертификаты</a>
    </nav>
@endsection
@section('content')
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Личные данные</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">ФИО</div>
                            <div class="col">1</div>
                        </div>
                        <div class="row">
                            <div class="col">ИНН</div>
                            <div class="col">2</div>
                        </div>
                        <div class="row">
                            <div class="col">СНИЛС</div>
                            <div class="col">3</div>
                        </div>
                        <div class="row">
                            <div class="col">Табельный номер</div>
                            <div class="col">4</div>
                        </div>
                        <div class="row">
                            <div class="col">Подразделение</div>
                            <div class="col">5</div>
                        </div>
                        <div class="row">
                            <div class="col">Должность</div>
                            <div class="col">6</div>
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
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how your name will appear to other
                                    users on the site)</label>
                                <input class="form-control" id="inputUsername" type="text"
                                    placeholder="Enter your username" value="username">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                    <input class="form-control" id="inputFirstName" type="text"
                                        placeholder="Enter your first name" value="Valerie">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                    <input class="form-control" id="inputLastName" type="text"
                                        placeholder="Enter your last name" value="Luna">
                                </div>
                            </div>
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Organization name</label>
                                    <input class="form-control" id="inputOrgName" type="text"
                                        placeholder="Enter your organization name" value="Start Bootstrap">
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Location</label>
                                    <input class="form-control" id="inputLocation" type="text"
                                        placeholder="Enter your location" value="San Francisco, CA">
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" type="email"
                                    placeholder="Enter your email address" value="name@example.com">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" type="tel"
                                        placeholder="Enter your phone number" value="555-123-4567">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Birthday</label>
                                    <input class="form-control" id="inputBirthday" type="text" name="birthday"
                                        placeholder="Enter your birthday" value="06/10/1988">
                                </div>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="button">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

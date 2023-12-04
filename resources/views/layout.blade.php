<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('osfrportal::layout.header')
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-auto col-lg-auto me-0 px-3 fs-6" href="{{ route('osfrportal.mainpage') }}">
            {{--  <a class="navbar-brand col-md-3 col-lg-3 me-0 px-3 fs-6" href="{{ route('mainpage') }}"> --}}
            <img src="{{ asset('osfrportal/images/logo.svg') }}" alt="" class="d-inline-block align-text-middle">
            {{ Config::get('osfrportal.portal_name') }}
        </a>

        <div class="px-3 text-white text-decoration-none text-nowrap bg-primary rounded-0 border-0">@yield('dashboardTitle', '')
        </div>
        <div class="form-control form-control-dark bg-primary rounded-0 border-0">
            <a role="button" class="btn btn-primary" id="btn-back-to-top">
                <h3 class="bi bi-arrow-up-circle"></h3>
            </a>
        </div>
        <!-- input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search" -->

        @auth
            <!-- Icons -->
            <div class="px-3">
                @livewire('osfrportal::docsnotsigned-count')
            </div>
            <div class="px-3">
                <a class="nav-link position-relative" href="{{ route('osfrportal.dashboard') }}" alt="Уведомления"
                    id="dropdownNotifications">
                    @livewire('osfrportal::notifications-count')
                </a>
            </div>
            <div class="dropdown px-3">
                <a href="#" class="d-block text-white text-decoration-none dropdown-toggle text-nowrap"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle iconsMenu"></i> <span
                        class="fs-6">&nbsp;{{ auth()->user()->SfrPerson->getFullName() }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-start" aria-labelledby="dropdownUser1" style="">
                    <li><a class="dropdown-item" href="{{ route('osfrportal.dashboard') }}">Личный кабинет</a></li>
                    <li><a class="dropdown-item" href="{{ route('osfrportal.profile.index') }}">Профиль</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('osfrportal.logout') }}">Выход</a></li>
                </ul>
            </div>
        @endauth
        @guest
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="px-3 btn-primary btn" href="{{ route('osfrportal.login') }}" role="button">Войти</a>
                </div>
            </div>
        @endguest
    </header>
    @include('osfrportal::layout.main')
    @include('osfrportal::layout.footer')
</body>

</html>

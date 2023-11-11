@extends('osfrportal::layout')
@section('title')
    Вход в систему
@endsection
@section('content')
    @auth
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ session::get('success') }}
            </div>
        @endif
        Добро пожаловать {{ auth()->user()->SfrPerson->psurname }} {{ auth()->user()->SfrPerson->pname }} {{ auth()->user()->SfrPerson->pmiddlename }} ({{ auth()->user()->username }})<br>

        <a href="{{ route('osfrportal.logout') }}">Выход из системы</a>
    @endauth

    @guest
        <main class="login-form">
            <div class="cotainer">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                @include('osfrportal::sections.auth.loginform')
                            </div>
                        </div>
                        @if (Session::get('error'))
                            <div class="alert alert-danger">
                                {{ session::get('error') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>

    @endguest
@endsection

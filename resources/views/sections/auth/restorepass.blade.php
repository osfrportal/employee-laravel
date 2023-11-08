@extends('osfrportal::layout')
@section('title')
    Восстановление пароля
@endsection
@section('content')
    @guest
        <main class="login-form">
            <div class="cotainer">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                @if (session('passwordSended'))
                                    <div class="alert alert-success">
                                        {{ session('passwordSended') }}
                                    </div>
                                @else
                                    @include('osfrportal::sections.auth.restorepassform')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    @endguest
@endsection

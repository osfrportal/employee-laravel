@extends('osfrportal::layout')
@section('content')
    <div class="container">
        <form method="POST" action="#">
            <input type="hidden" id="cryptouuid" name="cryptouuid" value="{{ $cryptoDataFull->cryptouuid }}">
            <div class="card mb-4">
                <div class="card-header">Контактные данные</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="mb-1" for="cryptoName">Имя узла:</label>
                        <input class="form-control form-control-sm @error('cryptoName') is-invalid @enderror"
                            id="cryptoName" name="cryptoName" type="email" placeholder="Введите имя узла VipNet"
                            value="{{ old('cryptoName') ?? ($cryptoDataFull->cryptoName ?? '') }}">
                        @error('cryptoName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

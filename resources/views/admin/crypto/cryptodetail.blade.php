@extends('osfrportal::layout')
@section('content')
    <div class="container">
        <form method="POST" action="#">
            <input type="hidden" id="cryptouuid" name="cryptouuid" value="{{ $cryptoDataFull->cryptouuid }}">
            <div class="card mb-4">
                <div class="card-header">Информация о криптосредстве</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="mb-1" for="cryptoType">Тип криптосредства:</label>
                        <input class="form-control form-control-sm @error('cryptoType') is-invalid @enderror"
                            id="cryptoType" name="cryptoType" type="text" placeholder="Введите имя узла VipNet"
                            value="{{ old('cryptoType') ?? ($cryptoDataFull->cryptoType ?? '') }}">
                        @error('cryptoType')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">VipNet</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="mb-1" for="cryptoName">Имя узла:</label>
                                <input class="form-control form-control-sm @error('cryptoName') is-invalid @enderror"
                                    id="cryptoName" name="cryptoName" type="text" placeholder="Введите имя узла VipNet"
                                    value="{{ old('cryptoName') ?? ($cryptoDataFull->cryptoName ?? '') }}">
                                @error('cryptoName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">КриптоПРО</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="mb-1" for="cryptoLicenseNumber">Номер лицензии:</label>
                                <input
                                    class="form-control form-control-sm @error('cryptoLicenseNumber') is-invalid @enderror"
                                    id="cryptoLicenseNumber" name="cryptoLicenseNumber" type="text"
                                    placeholder="Введите номер лицензии криптопро"
                                    value="{{ old('cryptoLicenseNumber') ?? ($cryptoDataFull->cryptoLicenseNumber ?? '') }}">
                                @error('cryptoLicenseNumber')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

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
                        <select name="cryptoType" id="cryptoType"
                            class="form-control form-control-sm @error('cryptoType') is-invalid @enderror">
                            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET()->value }}"
                                @selected(old('version') == $version)>
                                {{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET()->label }}
                            </option>
                        </select>
                        @error('cryptoType')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="cryptoType">Назначение:</label>
                        <input class="form-control form-control-sm @error('cryptoPurpose') is-invalid @enderror"
                            id="cryptoPurpose" name="cryptoPurpose" type="text"
                            value="{{ old('cryptoPurpose') ?? ($cryptoDataFull->cryptoPurpose ?? '') }}">
                        @error('cryptoPurpose')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">Работник</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="text-xs">ФИО: <a
                                        href="{{ route('osfrportal.admin.persons.detail', $cryptoDataFull->pid) }}"
                                        target="_blank">{{ $cryptoDataFull->personContactData['contactFullname'] ?? '' }}</a>
                                </div>
                                <div class="text-xs">Должность:
                                    {{ $cryptoDataFull->personContactData['contactAppointment'] ?? '' }}</div>
                                <div class="text-xs">Подразделение:
                                    {{ $cryptoDataFull->personContactData['contactUnit'] ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                    @switch($cryptoDataFull->cryptoType)
                        @case(Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET())
                            <div class="card mb-4">
                                <div class="card-header">VipNet</div>
                                <div class="card-body">
                                    <div class="small text-muted mb-3">
                                        Данные загружаются автоматически из файла экспорта структуры сети ЦУС.
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1" for="cryptoId">ID узла:</label>
                                        <input class="form-control form-control-sm @error('cryptoId') is-invalid @enderror"
                                            id="cryptoId" name="cryptoId" type="text" placeholder="Введите ID узла VipNet"
                                            value="{{ old('cryptoId') ?? ($cryptoDataFull->cryptoId ?? '') }}" @readonly(true)>
                                        @error('cryptoId')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1" for="cryptoName">Имя узла:</label>
                                        <input class="form-control form-control-sm @error('cryptoName') is-invalid @enderror"
                                            id="cryptoName" name="cryptoName" type="text" placeholder="Введите имя узла VipNet"
                                            value="{{ old('cryptoName') ?? ($cryptoDataFull->cryptoName ?? '') }}"
                                            @readonly(true)>
                                        @error('cryptoName')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1" for="cryptoUserName">Имя пользователя:</label>
                                        <input class="form-control form-control-sm @error('cryptoUserName') is-invalid @enderror"
                                            id="cryptoUserName" name="cryptoUserName" type="text"
                                            placeholder="Введите имя пользователя VipNet"
                                            value="{{ old('cryptoUserName') ?? ($cryptoDataFull->cryptoUserName ?? '') }}"
                                            @readonly(true)>
                                        @error('cryptoUserName')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @break

                        @case(Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO())
                            <div class="card mb-4">
                                <div class="card-header">КриптоПРО</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="mb-1" for="cryptoLicenseNumber">Номер лицензии:</label>
                                        <input
                                            class="form-control form-control-sm @error('cryptoLicenseNumber') is-invalid @enderror"
                                            id="cryptoLicenseNumber" name="cryptoLicenseNumber" type="text"
                                            placeholder="Введите номер лицензии"
                                            value="{{ old('cryptoLicenseNumber') ?? ($cryptoDataFull->cryptoLicenseNumber ?? '') }}">
                                        @error('cryptoLicenseNumber')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @break
                    @endswitch
                </div>
            </div>
        </form>
    </div>
@endsection

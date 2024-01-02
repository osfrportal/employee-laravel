@extends('osfrportal::layout')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('osfrportal.admin.crypto.detail.save') }}">
            @csrf
            <input type="hidden" id="cryptouuid" name="cryptouuid" value="{{ $cryptoDataFull->cryptouuid }}">
            <div class="card mb-4">
                <div class="card-header">Информация о криптосредстве</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="mb-1" for="cryptoType">Тип криптосредства:</label>
                        <select name="cryptoType" id="cryptoType" class="form-control form-control-sm" disabled>
                            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::NONE()->value }}"
                                @selected($cryptoDataFull->cryptoType == Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::NONE())>
                                {{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::NONE()->label }}
                            </option>
                            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO()->value }}"
                                @selected($cryptoDataFull->cryptoType == Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO())>
                                {{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO()->label }}
                            </option>
                            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET()->value }}"
                                @selected($cryptoDataFull->cryptoType == Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET())>
                                {{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET()->label }}
                            </option>
                        </select>
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
                            <div>
                                @if ($cryptoDataFull->pid)
                                    <input type="hidden" name="personid" id="personid"
                                        value="{{ $cryptoDataFull->pid }}">
                                    <div class="text-xs">ФИО: <a
                                            href="{{ route('osfrportal.admin.persons.detail', $cryptoDataFull->pid) }}"
                                            target="_blank">{{ $cryptoDataFull->personContactData['contactFullname'] ?? '' }}</a>
                                    </div>
                                    <div class="text-xs">Должность:
                                        {{ $cryptoDataFull->personContactData['contactAppointment'] ?? '' }}</div>
                                    <div class="text-xs">Подразделение:
                                        {{ $cryptoDataFull->personContactData['contactUnit'] ?? '' }}</div>
                                @else
                                    <select class="form-select form-select-sm mb-3" id="js-persons-ajax" name="personid"
                                        data-placeholder="Выберите работника" data-allow-clear="true"
                                        data-minimum-input-length="4" data-ajax--delay="500" data-language="ru"
                                        data-selection-css-class="select2--small"
                                        data-dropdown-css-class="select2--small"></select>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-sm btn-outline-danger" href="{{ route('osfrportal.admin.crypto.index') }}"><i
                                    class="ti ti-shield icon-size-24"></i>
                                Удалить назначение работнику</a>
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
                                            value="{{ old('cryptoLicenseNumber') ?? ($cryptoDataFull->cryptoLicenseNumber ?? '') }}"
                                            data-inputmask="'mask': '*{5}-*{5}-*{5}-*{5}-*{5}'">
                                        @error('cryptoLicenseNumber')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @break
                    @endswitch
                    <div id="form_buttons_wrapper" class="mb-3">
                        <div class="row">
                            <div class="col-6 text-start">
                                <input class="btn btn-primary" type="submit" value="Сохранить">
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-sm btn-outline-primary"
                                    href="{{ route('osfrportal.admin.crypto.index') }}"><i
                                        class="ti ti-shield icon-size-24"></i>
                                    К списку</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#js-persons-ajax').select2({
                ajax: {
                    dataType: 'json',
                    url: function(params) {
                        var urlroute =
                            '{{ route('osfrapi.osfrportal.admin.select2.persons.search', ':slug') }}';
                        urlroute = urlroute.replace(':slug', params.term);
                        return urlroute;
                    }
                }
            });
        });
    </script>
@endpush

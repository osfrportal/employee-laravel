@extends('osfrportal::layout')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('osfrportal.admin.crypto.new.save') }}">
            @csrf
            <div class="card mb-4">
                <div class="card-header">Добавление криптосредства</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="mb-1" for="cryptoType">Тип криптосредства:</label>
                        <select name="cryptoType" id="cryptoType"
                            class="form-control form-control-sm @error('cryptoType') is-invalid @enderror">
                            <option value="99" @selected(old('cryptoType') == 99)>
                                {{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::NONE()->label }}
                            </option>
                            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO()->value }}"
                                @selected(old('cryptoType') == Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO())>
                                {{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO()->label }}
                            </option>
                            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET()->value }}"
                                @selected(old('cryptoType') == Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET()) disabled>
                                {{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET()->label }}
                            </option>
                        </select>
                        @error('cryptoType')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="font-italic text-muted mb-4">
                            Добавление криптосредств VipNet производится автоматически при загрузке структуры сети из ЦУСа.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="cryptoType">Назначение:</label>
                        <input class="form-control form-control-sm @error('cryptoPurpose') is-invalid @enderror"
                            id="cryptoPurpose" name="cryptoPurpose" type="text" value="{{ old('cryptoPurpose') ?? '' }}">
                        @error('cryptoPurpose')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">Работник</div>
                        <div class="card-body">
                            <select class="form-select form-select-sm mb-3" id="js-persons-ajax" name="personid"
                                data-placeholder="Выберите работника" data-allow-clear="true" data-minimum-input-length="4"
                                data-ajax--delay="500" data-language="ru" data-selection-css-class="select2--small"
                                data-dropdown-css-class="select2--small"></select>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            {{ Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO()->label }}</div>
                        <div class="card-body">
                            <label class="mb-1" for="cryptoLicenseNumber">Номер лицензии:</label>
                            <input class="form-control form-control-sm @error('cryptoLicenseNumber') is-invalid @enderror"
                                id="cryptoLicenseNumber" name="cryptoLicenseNumber" type="text"
                                value="{{ old('cryptoLicenseNumber') ?? '' }}"
                                data-inputmask="'mask': '*{5}-*{5}-*{5}-*{5}-*{5}'">
                            @error('cryptoLicenseNumber')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <input class="btn btn-primary" type="submit" value="Добавить">
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

@extends('osfrportal::layout')
@push('header-css')
    <link href="{{ asset('osfrportal/css/profile.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if (!is_null($rfidKeysUser))
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Карты доступа СКУД
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach ($rfidKeysUser as $rfidKey)
                                    <div
                                        class="list-group-item list-group-item-{{ $rfidKey->tkeydata->IsInStopList === true || $rfidKey->tkeydata->IsBlocked === true ? 'danger' : 'success' }} bg-opacity-25">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                @if ($rfidKey->tkeydata->CodeType === 1)
                                                    <div
                                                        class="ti ti-key{{ $rfidKey->tkeydata->IsInStopList === true || $rfidKey->tkeydata->IsBlocked === true ? '-off' : '' }} icon-size-32">
                                                    </div>
                                                @else
                                                    <div
                                                        class="ti ti-id-badge{{ $rfidKey->tkeydata->IsInStopList === true || $rfidKey->tkeydata->IsBlocked === true ? '-off' : '' }} icon-size-32">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col text-truncate">
                                                <div class="d-block text-truncate">
                                                    @switch($rfidKey->tkeydata->CodeType)
                                                        @case(1)
                                                            Пароль ОрионПРО
                                                        @break

                                                        @default
                                                            Карта СКУД
                                                    @endswitch
                                                </div>
                                                <small class="text-muted d-block">Статус:
                                                    {{ $rfidKey->tkeydata->IsBlocked === true ? 'заблокирована' : 'активна' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{--
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Устройства хранения данных, Jacarta/Rutoken
                    </div>
                    <div class="card-body px-0">

                        <div class="d-flex align-items-center justify-content-between px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-usb-drive fa-2x"></i>
                                <div class="ms-4">
                                    <div class="text-xs text-muted">USB Flash</div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="d-flex align-items-center justify-content-between px-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('osfrportal/images/logo_token.svg') }}" alt=""
                                    class="icon-small" />
                                <div class="ms-4">
                                    <div class="text-xs text-muted">JaCarta</div>
                                    <div class="small">Серийный номер: А5588669</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            --}}
            @if ($stampsUser->count() > 0)
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Металлические печати
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach ($stampsUser as $stamp)
                                    <div class="list-group-item list-group-item-success bg-opacity-25">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="ti ti-disk icon-size-32"></div>
                                            </div>
                                            <div class="col text-truncate">
                                                <div class="d-block text-truncate">
                                                    Металлическая печать №{{ $stamp->Stamp->stampnumber ?? '' }}
                                                </div>
                                                <small class="text-muted d-block">Описание:
                                                    {{ $stamp->Stamp->stampdescription ?? '' }}</small>
                                                <small class="text-muted d-block">Выдана
                                                    {{ $stamp->stampjissue_at->format('d.m.Y') ?? '' }},
                                                    учетный №{{ $stamp->stampjpapernumber ?? '' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="row pt-2">
            @if ($certsUser->count() > 0)
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Электронная подпись
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach ($certsUser as $cert)
                                    <div
                                        class="list-group-item @if ($cert->revoked) {{ 'list-group-item-danger' }} @else {{ $cert->certvalidto->isPast() ? 'list-group-item-dark' : 'list-group-item-success' }} @endif bg-opacity-25">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div
                                                    class="ti ti-award{{ $cert->revoked || $cert->certvalidto->isPast() ? '-off' : '' }} icon-size-32">
                                                </div>
                                            </div>
                                            <div class="col text-truncate">
                                                <div class="ms-4">
                                                    @if ($cert->revoked)
                                                        <div class="text-xs">
                                                            <b>ОТОЗВАН {{ $cert->revokedate->format('d.m.Y') ?? '' }}</b>
                                                        </div>
                                                    @else
                                                        @if ($cert->certvalidto->isPast())
                                                            <div class="text-xs">Истек:
                                                                {{ $cert->certvalidto->format('d.m.Y') ?? '' }}
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <div
                                                        class="{{ $cert->certvalidto->isPast() || $cert->revoked ? 'small text-muted' : 'text-xs' }}">
                                                        Вид:
                                                        @switch($cert->certtype)
                                                            @case(Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum::UKEP())
                                                                Усиленный квалифицированный (УКЭП)
                                                            @break

                                                            @case(Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum::UNEP())
                                                                Усиленный неквалифицированный (УНЭП)
                                                            @break

                                                            @case(Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum::DOMAIN())
                                                                Вход в операционную систему (ActiveDirectory)
                                                            @break

                                                            @default
                                                                Не определен
                                                        @endswitch
                                                    </div>
                                                    @if (!is_null($cert->certdata->Ogrn) && !is_null($cert->certdata->Innle))
                                                        <div class="text-xs">
                                                            Тип: Сертификат юридического лица
                                                        </div>
                                                    @endif
                                                    <div
                                                        class="{{ $cert->certvalidto->isPast() || $cert->revoked ? 'small text-muted' : 'text-xs' }}">
                                                        Кому выдан: {{ $cert->certdata->commonName ?? '' }}
                                                    </div>
                                                    <div
                                                        class="{{ $cert->certvalidto->isPast() || $cert->revoked ? 'small text-muted' : 'text-xs' }}">
                                                        Срок действия: с
                                                        {{ $cert->certvalidfrom->format('d.m.Y') ?? '' }}
                                                        по
                                                        {{ $cert->certvalidto->format('d.m.Y') ?? '' }}</div>
                                                    <div class="small text-muted">
                                                        Номер сертификата: {{ $cert->certserial ?? '' }}
                                                    </div>
                                                    <div class="small text-muted">
                                                        Издатель: {{ $cert->certdata->iss_commonName ?? '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($cryptoUser->count() > 0)
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Криптосредства
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach ($cryptoUser as $crypto)
                                    <div class="list-group-item list-group-item-success bg-opacity-25">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                @switch($crypto->cryptotype)
                                                    @case(Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO())
                                                        <img src="{{ asset('osfrportal/images/logo_cryptopro_csp.svg') }}"
                                                            alt="" class="icon-small" />
                                                    @break

                                                    @case(Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET())
                                                        <img src="{{ asset('osfrportal/images/logo_vipnet.svg') }}" alt=""
                                                            class="icon-small" />
                                                    @break

                                                    @default
                                                        Не определен
                                                @endswitch
                                            </div>
                                            <div class="col text-truncate">
                                                <div class="ms-4">
                                                    @switch($crypto->cryptotype)
                                                        @case(Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::CRYPTOPRO())
                                                            <div class="text-xs">Криптопро 4</div>
                                                        @break

                                                        @case(Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET())
                                                            <div class="text-xs">VipNet Деловая Почта</div>
                                                            <div class="text-xs">Наименование АП:
                                                                {{ $crypto->cryptodata->cryptoName }}</div>
                                                        @break

                                                        @default
                                                            Не определен
                                                    @endswitch
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@extends('osfrportal::layout')
@section('dashboardTitle', 'Профиль пользователя')
@push('header-css')
    <link href="{{ asset('osfrportal/css/profile.css') }}" rel="stylesheet">
@endpush
@section('title2')
    @include('osfrportal::sections.profile.profilemenu')
@endsection
@section('content')
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            @if (!is_null($rfidKeysUser))
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Карты доступа СКУД
                        </div>
                        <div class="card-body px-0">
                            @foreach ($rfidKeysUser as $rfidKey)
                                <div
                                    class="d-flex align-items-center justify-content-between px-4 @if ($rfidKey->tkeydata->IsInStopList === true || $rfidKey->tkeydata->IsBlocked === true) {{ 'alert alert-danger' }} @else {{ 'alert alert-success' }} @endif">
                                    <div class="d-flex align-items-center">
                                        <i
                                            class="bi {{ $rfidKey->tkeydata->CodeType === 1 ? 'bi-key' : 'bi-credit-card' }}"></i>
                                        <div class="ms-4">
                                            <div class="text-xs text-muted">
                                                @switch($rfidKey->tkeydata->CodeType)
                                                    @case(1)
                                                        Пароль ОрионПРО
                                                    @break

                                                    @default
                                                        Карта СКУД
                                                @endswitch
                                            </div>
                                            <div class="small">Статус:
                                                {{ $rfidKey->tkeydata->IsBlocked === true ? 'заблокирована' : 'активна' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-4 small">
                                        <a href="#{{ $rfidKey->keyid }}">Подробнее</a>
                                    </div>
                                </div>
                            @endforeach
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
                        <div class="card-body px-0">
                            @foreach ($stampsUser as $stamp)
                                <div class="d-flex align-items-center justify-content-between px-4 alert alert-success">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-disc"></i>
                                        <div class="ms-4">
                                            <div class="text-xs text-muted">Металлическая печать
                                                №{{ $stamp->Stamp->stampnumber ?? '' }}</div>
                                            <div class="small">Описание: {{ $stamp->Stamp->stampdescription ?? '' }}</div>
                                            <div class="small">Выдана {{ $stamp->stampjissue_at->format('d.m.Y') ?? '' }},
                                                учетный №{{ $stamp->stampjpapernumber ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            @endif
        </div>

        <div class="row">
            @if ($certsUser->count() > 0)
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Электронная подпись
                        </div>
                        <div class="card-body px-0">
                            @foreach ($certsUser as $cert)
                                <div
                                    class="d-flex align-items-center justify-content-between px-4 @if ($cert->revoked) {{ 'alert alert-danger' }} @else {{ $cert->certvalidto->isPast() ? 'alert alert-dark' : 'alert alert-success' }} @endif">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('osfrportal/images/logo_certificate.svg') }}" alt=""
                                            class="icon-small" />
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
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            {{--
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Криптосредства
                    </div>
                    <div class="card-body px-0">

                        <div class="d-flex align-items-center justify-content-between px-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('osfrportal/images/logo_cryptopro_csp.svg') }}" alt=""
                                    class="icon-small" />
                                <div class="ms-4">
                                    <div class="text-xs text-muted">Криптопро 4</div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="d-flex align-items-center justify-content-between px-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('osfrportal/images/logo_vipnet.svg') }}" alt=""
                                    class="icon-small" />
                                <div class="ms-4">
                                    <div class="text-xs text-muted">VipNet Деловая Почта</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            --}}
        </div>
    </div>
@endsection

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
                            <div class="list-group list-group-flush list-group-hoverable">
                                @foreach ($rfidKeysUser as $rfidKey)
                                    <div class="list-group-item {{ ($rfidKey->tkeydata->IsInStopList === true || $rfidKey->tkeydata->IsBlocked === true) ? 'bg-danger' : 'bg-success' }} bg-opacity-25">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                @if ($rfidKey->tkeydata->CodeType === 1)
                                                    <i
                                                        class="ti ti-key{{ ($rfidKey->tkeydata->IsInStopList === true || $rfidKey->tkeydata->IsBlocked === true) ? '-off' : '' }} icon-size-32"></i>
                                                @else
                                                    <i
                                                        class="icon-size-32-rfid{{ ($rfidKey->tkeydata->IsInStopList === true || $rfidKey->tkeydata->IsBlocked === true) ? '-off' : '' }}"></i>
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
                            @foreach ($rfidKeysUser as $rfidKey)
                                <div
                                    class="d-flex align-items-center justify-content-between px-4 @if ($rfidKey->tkeydata->IsInStopList === true || $rfidKey->tkeydata->IsBlocked === true) {{ 'alert alert-danger' }} @else {{ 'alert alert-success' }} @endif">
                                    <div class="d-flex align-items-center">
                                        @if ($rfidKey->tkeydata->IsInStopList === true || $rfidKey->tkeydata->IsBlocked === true)
                                            @if ($rfidKey->tkeydata->CodeType === 1)
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-key-off" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.17 6.159l2.316 -2.316a2.877 2.877 0 0 1 4.069 0l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.33 2.33" />
                                                    <path
                                                        d="M14.931 14.948a2.863 2.863 0 0 1 -1.486 -.79l-.301 -.302l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.863 2.863 0 0 1 -.794 -1.504" />
                                                    <path d="M15 9h.01" />
                                                    <path d="M3 3l18 18" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-id-badge-off" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M7.141 3.125a3 3 0 0 1 .859 -.125h8a3 3 0 0 1 3 3v9m-.13 3.874a3 3 0 0 1 -2.87 2.126h-8a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 .128 -.869" />
                                                    <path d="M11.179 11.176a2 2 0 1 0 2.635 2.667" />
                                                    <path d="M10 6h4" />
                                                    <path d="M9 18h6" />
                                                    <path d="M3 3l18 18" />
                                                </svg>
                                            @endif
                                        @else
                                            @if ($rfidKey->tkeydata->CodeType === 1)
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-key" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                                                    <path d="M15 9h.01" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-id-badge" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M5 3m0 3a3 3 0 0 1 3 -3h8a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-8a3 3 0 0 1 -3 -3z" />
                                                    <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M10 6h4" />
                                                    <path d="M9 18h6" />
                                                </svg>
                                            @endif
                                        @endif
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
                                        @if ($cert->revoked || $cert->certvalidto->isPast())
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-award-off" width="32" height="32"
                                                viewBox="0 0 32 32" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M16.72 12.704a6 6 0 0 0 -8.433 -8.418m-1.755 2.24a6 6 0 0 0 7.936 7.944" />
                                                <path d="M12 15l3.4 5.89l1.598 -3.233l.707 .046m1.108 -2.902l-1.617 -2.8" />
                                                <path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-award" width="32" height="32"
                                                viewBox="0 0 32 32" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                                                <path d="M12 15l3.4 5.89l1.598 -3.233l3.598 .232l-3.4 -5.889" />
                                                <path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" />
                                            </svg>
                                        @endif
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

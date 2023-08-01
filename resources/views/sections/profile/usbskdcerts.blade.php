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
            {{--
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Карты доступа СКУД
                    </div>
                    <div class="card-body px-0">
                        <div class="d-flex align-items-center justify-content-between px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-credit-card fa-2x"></i>
                                <div class="ms-4">
                                    <div class="text-xs text-muted">Карта СКУД</div>
                                    <div class="small">Статус: активна</div>
                                </div>
                            </div>
                            <div class="ms-4 small">
                                <a href="#!">Подробнее</a>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex align-items-center justify-content-between px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-credit-card fa-2x"></i>
                                <div class="ms-4">
                                    <div class="text-xs text-muted">Карта СКУД</div>
                                    <div class="small">Статус: заблокирована</div>
                                </div>
                            </div>
                            <div class="ms-4 small">
                                <a href="#!">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            --}}
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
            {{--
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Металлические печати
                    </div>
                    <div class="card-body px-0">

                        <div class="d-flex align-items-center justify-content-between px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-disc fa-2x"></i>
                                <div class="ms-4">
                                    <div class="text-xs text-muted">Металлическая печать</div>
                                    <div class="small">Номер печати: 123</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            --}}
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
                                <div class="d-flex align-items-center justify-content-between px-4">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('osfrportal/images/logo_certificate.svg') }}" alt=""
                                            class="icon-small" />
                                        <div class="ms-4">
                                            <div
                                                class="text-xs @if ($cert->certvalidto->isPast()) text-decoration-line-through @endif">
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
                                            <div
                                                class="text-xs @if ($cert->certvalidto->isPast()) text-decoration-line-through @endif">
                                                Срок действия: с
                                                {{ $cert->certvalidfrom->format('d.m.Y') ?? '' }}
                                                по
                                                {{ $cert->certvalidto->format('d.m.Y') ?? '' }}</div>
                                            @if ($cert->certvalidto->isPast())
                                                <div class="text-xs">Истек: {{ $cert->certvalidto->format('d.m.Y') ?? '' }}
                                                </div>
                                            @endif
                                            <div
                                                class="small text-muted @if ($cert->certvalidto->isPast()) text-decoration-line-through @endif">
                                                Номер сертификата: {{ $cert->certserial ?? '' }}
                                            </div>
                                            <div
                                                class="small text-muted @if ($cert->certvalidto->isPast()) text-decoration-line-through @endif">
                                                Выдан: {{ $cert->certdata->iss_commonName ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
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

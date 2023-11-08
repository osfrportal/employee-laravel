<div class="container-fluid px-4 mt-4">
    <div class="row">
        @if (!is_null($rfidKeysUser))
            @if ($rfidKeysUser->count() > 0)
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
                                            @if ($rfidKey->tkeydata->CodeType !== 1)
                                                <div class="small">Код карты:
                                                    {{ $rfidKey->tkeydata->Code }}
                                                </div>
                                            @endif
                                            <div class="small">Статус:
                                                {{ $rfidKey->tkeydata->IsBlocked === true ? 'заблокирована' : 'активна' }}
                                                @if ($rfidKey->tkeydata->IsInStopList === true)
                                                    &nbsp;в СТОП листе
                                                @endif
                                            </div>
                                            <div class="small">Комментарий:
                                                {{ $rfidKey->tkeydata->Comment }}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="ms-4 small">
                                        <a data-id="{{ $rfidKey->keyid }}" class="btn btn-sm btn-link" type="button"
                                            data-bs-toggle="modal" data-bs-target="#rfidDataModal">Подробнее</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
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
            @if ($SFRPersonStamps->count() > 0)

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Металлические печати
                    </div>
                    <div class="card-body px-0">
                        @foreach ($SFRPersonStamps as $stamp)
                        <div class="d-flex align-items-center justify-content-between px-4 alert alert-success">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-disc"></i>
                                <div class="ms-4">
                                    <div class="text-xs text-muted">Металлическая печать №{{ $stamp->Stamp->stampnumber ?? ''}}</div>
                                    <div class="small">Описание: {{ $stamp->Stamp->stampdescription ?? ''}}</div>
                                    <div class="small">Выдана {{ $stamp->stampjissue_at->format('d.m.Y') ?? ''}}, учетный №{{ $stamp->stampjpapernumber ?? ''}}</div>
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
        @if ($SFRPersonCerts->count() > 0)
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Электронная подпись
                    </div>
                    <div class="card-body px-0">
                        @foreach ($SFRPersonCerts as $cert)
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
<!-- Modal -->
<div class="modal fade" id="rfidDataModal" tabindex="-1" aria-labelledby="rfidDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="rfidDataModalLabel">Информация о карте доступа СКУД</h1>
            </div>
            <div class="modal-body">
                В разработке
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
@push('footer-scripts')
    <script type="text/javascript">
        const rfidDataModal = document.getElementById('rfidDataModal')
        rfidDataModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const rfidID = button.getAttribute('data-id')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            //const modalTitle = rfidDataModal.querySelector('.modal-title')
            //const modalBodyInput = rfidDataModal.querySelector('.modal-body input')

            //modalTitle.textContent = `New message to ${rfidID}`
            //modalBodyInput.value = rfidID
        })
    </script>
@endpush

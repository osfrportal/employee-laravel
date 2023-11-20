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
                                    @if ($cert->revoked || $cert->certvalidto->isPast())
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-award-off" width="32" height="32" viewBox="0 0 32 32" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M16.72 12.704a6 6 0 0 0 -8.433 -8.418m-1.755 2.24a6 6 0 0 0 7.936 7.944" />
                                            <path d="M12 15l3.4 5.89l1.598 -3.233l.707 .046m1.108 -2.902l-1.617 -2.8" />
                                            <path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" />
                                            <path d="M3 3l18 18" />
                                          </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-award" width="32" height="32" viewBox="0 0 32 32" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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

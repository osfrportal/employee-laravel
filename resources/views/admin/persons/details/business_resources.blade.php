<div class="container-fluid mt-2">
    <div class="row">
        @if (!is_null($rfidKeysUser))
            @if ($rfidKeysUser->count() > 0)
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
                                                @if ($rfidKey->tkeydata->CodeType != 1)
                                                    <small class="text-muted d-block">Номер:
                                                        {{ $rfidKey->tkeydata->Code ?? '' }}</small>
                                                @endif
                                                <small class="text-muted d-block">Статус:
                                                    {{ $rfidKey->tkeydata->IsBlocked === true ? 'заблокирована' : 'активна' }}</small>
                                                <small class="text-muted d-block">Комментарий:
                                                    {{ $rfidKey->tkeydata->Comment ?? '' }}</small>
                                            </div>
                                            <div class="col">
                                                <a data-id="{{ $rfidKey->keyid }}" class="btn btn-sm btn-link"
                                                    type="button" data-bs-toggle="modal"
                                                    data-bs-target="#rfidDataModal">Подробнее</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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

    <div class="row pt-2">
        @if ($SFRPersonCerts->count() > 0)
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Электронная подпись
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach ($SFRPersonCerts as $cert)
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
        @if ($SFRPersonCrypto->count() > 0)
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Криптосредства
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach ($SFRPersonCrypto as $crypto)
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
                                                        <div class="text-xs">Номер лицензии: {{ $crypto->cryptodata->cryptoLicenseNumber ?? ''}}</div>
                                                        <div class="text-xs">ПК: {{ $crypto->cryptodata->wsId ?? ''}}</div>
                                                    @break

                                                    @case(Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum::VIPNET())
                                                        <div class="text-xs">VipNet Деловая Почта</div>
                                                        <div class="text-xs">Наименование АП: {{ $crypto->cryptodata->cryptoName ?? ''}}</div>
                                                        <div class="text-xs">ID АП: {{ $crypto->cryptodata->cryptoId ?? ''}}</div>
                                                        <div class="text-xs">ПК: {{ $crypto->cryptodata->wsId ?? ''}}</div>
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
<!-- Modal -->
<div class="modal fade" id="rfidDataModal" tabindex="-1" aria-labelledby="rfidDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="rfidDataModalLabel">Информация о карте доступа СКУД</h1>
            </div>
            <div class="modal-body">
                Точки доступа, через которые разрешен проход:
                <ul id="modal-accesspoints-list">
                </ul>
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
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const rfidID = button.getAttribute('data-id');
            var urlroute = '{{ route('osfrapi.osfrportal.admin.orion.card.accesspoints', ':slug') }}';
            urlroute = urlroute.replace(':slug', rfidID);
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            //const modalTitle = rfidDataModal.querySelector('.modal-title')
            const modalBodyListAccessPoints = rfidDataModal.querySelector('#modal-accesspoints-list');
            modalBodyListAccessPoints.innerHTML = '';

            $.ajax({
                url: urlroute, // адрес, на который будет отправлен запрос
                success: function(data) { // если запрос успешен вызываем функцию
                    for (let accesspoint of data['results']) {
                        const $newLi = document.createElement('li');
                        $newLi.textContent = accesspoint['entrypointname'];
                        modalBodyListAccessPoints.appendChild($newLi);
                    }
                }
            });
            //modalTitle.textContent = `New message to ${rfidID}`
            //modalBodyInput.value = rfidID
        })
    </script>
@endpush

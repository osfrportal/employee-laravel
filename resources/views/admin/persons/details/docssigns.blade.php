<div class="card w-100">
    <h5 class="card-header text-center">
        Ведомость ознакомления работника с нормативными документами<br>
    </h5>
    <div class="card-header">
        Работник: {{ $SFRPersonData->persondata_fullname ?? '' }}<br>
        Дата формирования: {{ \Carbon\Carbon::now()->format('d.m.Y') }}
    </div>
    <div class="card-body px-0 text-center">
        <table class="table table-responsive">
            <thead class="table-light">
                <tr class="align-middle">
                    <td>Реквизиты документа</td>
                    <td>Описание файла</td>
                    <td>Дата ознакомления</td>
                    <td>Подпись</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($docsSignsUser as $docsSign)
                    <tr class="align-middle {{ !$docsSign['docSigned'] ? 'alert alert-danger' : '' }}">
                        <td>{{ $docsSign['docTypeName'] ?? '' }} {{ $docsSign['docDateNumber'] ?? '' }}
                            {{ $docsSign['docName'] ?? '' }}</td>
                        <td>{{ $docsSign['docFileDescription'] ?? '' }}</td>
                        @if ($docsSign['docSigned'] === true)
                            <td>{{ $docsSign['signDateTime'] ?? '' }}</td>
                            <td>

                                <div class="stamp">
                                    <div class="d-flex justify-content-start stampmain">
                                        <div class="p2"><img src="{{ asset('osfrportal/images/logo.svg') }}"
                                                alt=""></div>
                                        <div class="p2">&nbsp;</div>
                                        <div class="align-self-center p2">Документ подписан электронной подписью
                                            ({{ $docsSign['signLabel'] ?? '' }})
                                        </div>
                                    </div>
                                    <table class="stampbottom">
                                        <tr>
                                            <td>Сертификат:</td>
                                            <td>{{ $docsSign['signCertHash'] ?? '' }}</td>
                                        </tr>
                                        <tr class="stampbold">
                                            <td>Владелец:</td>
                                            <td>{{ $docsSign['signCertCN'] ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Действителен:</td>
                                            <td>{{ $docsSign['signCertValidDates'] ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Выдан:</td>
                                            <td>{{ $docsSign['signIssuerCN'] ?? '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        @else
                            <td colspan="2">Не ознакомлен</td>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@push('header-css')
    <style>
        .stamp {
            display: inline-block;
            font-family: var(--bs-font-monospace);
            padding: .5rem;
            border: 3px double var(--bs-blue);
            border-radius: 6px;
            color: var(--bs-blue);
        }

        .stampmain {
            font-size: .75rem;
            text-transform: uppercase;
            display: inline-block;
        }

        .stampbottom {
            margin-top: 3px;
            font-size: 0.75rem;
            white-space: nowrap;
            line-height: 100%;
        }

        .stampbottom td {
            padding: 0 1px;
        }

        .stampbold {
            font-weight: bold;
        }
    </style>
@endpush

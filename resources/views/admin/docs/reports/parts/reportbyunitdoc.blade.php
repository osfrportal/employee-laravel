@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item">Управление документами</li>
                <li class="breadcrumb-item">Отчеты</li>
                <li class="breadcrumb-item active">Ознакомление по подразделениям</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="card w-100">
        <h5 class="card-header text-center">
            Ведомость ознакомления работников с нормативными документами<br>
        </h5>
        <div class="card-header">
            Дата формирования: {{ \Carbon\Carbon::now()->format('d.m.Y') }}
        </div>
        <div class="card-body px-0 text-center">
            <table class="table table-hover table-responsive">
                <thead>
                    <tr class="align-middle">
                        <th scope="col">Подразделение</th>
                        <th scope="col">Работник</th>
                        <th scope="col">Дата ознакомления</th>
                        <th scope="col">Подпись</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($allDocsArray as $doc)
                        <tr class="table-group-divider">
                            <td colspan="4" class="font-monospace table-primary">{{ $doc->docTypeName }}
                                №{{ $doc->docNumber }} от {{ \Carbon\Carbon::parse($doc->docDate)->format('d.m.Y') }}
                                {{ $doc->docName }}</td>
                        </tr>
                        @foreach ($doc->docPersonSigns as $person)
                            @if ($person->signData->count() > 0)
                                @if ($withoutSigns)
                                    @foreach ($person->signData as $personSign)
                                        <tr class="align-middle">
                                            <td>{{ $person->personData->persondata_unit_name }}</td>
                                            <td>{{ $person->personData->persondata_fullname }}<br>{{ $person->personData->persondata_appointment }}
                                            </td>
                                            <td>{{ $personSign->signDateTime ?? '' }}</td>
                                            <td>
                                                <div class="stamp">
                                                    <div class="d-flex justify-content-start stampmain">
                                                        <div class="p2"><img
                                                                src="{{ asset('osfrportal/images/logo.svg') }}"
                                                                alt=""></div>
                                                        <div class="p2">&nbsp;</div>
                                                        <div class="align-self-center p2">Документ подписан электронной
                                                            подписью
                                                            ({{ $personSign->signLabel ?? '' }})
                                                        </div>
                                                    </div>
                                                    <table class="stampbottom">
                                                        <tr>
                                                            <td>Сертификат:</td>
                                                            <td>{{ $personSign->signCertHash ?? '' }}</td>
                                                        </tr>
                                                        <tr class="stampbold">
                                                            <td>Владелец:</td>
                                                            <td>{{ $personSign->signCertCN ?? '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Действителен:</td>
                                                            <td>{{ $personSign->signCertValidDates ?? '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Выдан:</td>
                                                            <td>{{ $personSign->signIssuerCN ?? '' }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @else
                                <tr class="align-middle alert alert-danger">
                                    <td>{{ $person->personData->persondata_unit_name }}</td>
                                    <td>{{ $person->personData->persondata_fullname }}<br>{{ $person->personData->persondata_appointment }}
                                    </td>
                                    <td colspan="2">Не ознакомлен</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
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

@extends('osfrportal::layout')
@section('content')
    <table class="table table-sm table-responsive table-striped align-middle">
        <thead>
            <tr>
                <th scope="col">Дата</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Работник</th>
                <th scope="col">Данные</th>
                <th scope="col">Обновил</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($phoneLogs as $logRecord)
                @if (!empty($logRecord['differences']))
                    <tr>
                        <th scope="row">{{ $logRecord['created_at'] }}</th>
                        <td>{{ $logRecord['message'] }}</td>
                        <td><a
                                href="{{ route('osfrportal.admin.persons.detail', ['personid' => $logRecord['personPid']]) }}">{{ $logRecord['personFullName'] }}</a>
                        </td>
                        <td class="text-center">
                            @if (empty($logRecord['differences']))
                                Данные не изменялись
                            @else
                                <table class="table table-sm mb-0 align-middle">
                                    @foreach ($logRecord['differences'] as $diffkey => $diffvalue)
                                        <tr>
                                            <td>
                                                {{ $logKeysDescription[$diffkey] ?? '' }}
                                            </td>
                                            <td>{{ $diffvalue['old'] ?? '' }}</td>
                                            <td><i class="bi bi-arrow-right"></i></td>
                                            <td>{{ $diffvalue['new'] ?? '' }}</td>

                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </td>
                        <td><a
                                href="{{ route('osfrportal.admin.persons.detail', ['personid' => $logRecord['sfrperson_pid']]) }}">{{ $logRecord['sfrperson_fio'] }}
                                ({{ $logRecord['sfrperson_username'] }})
                            </a></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection

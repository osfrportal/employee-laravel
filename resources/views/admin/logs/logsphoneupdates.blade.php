@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Логи</a></li>
                <li class="breadcrumb-item active">Журнал обновления телефонного справочника</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <table class="table table-sm table-responsive table-striped">
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
                <tr>
                    <th scope="row">{{ $logRecord['created_at'] }}</th>
                    <td>{{ $logRecord['message'] }}</td>
                    <td><a href="{{ route('osfrportal.admin.persons.detail', ['personid' => $logRecord['personPid']]) }}">{{ $logRecord['personFullName'] }}</a></td>
                    <td>
                        @foreach ($differences as $diff)
                            @dump($diff)
                        @endforeach
                    </td>
                    <td><a href="{{ route('osfrportal.admin.persons.detail', ['personid' => $logRecord['sfrperson_pid']]) }}">{{ $logRecord['sfrperson_fio'] }} ({{ $logRecord['sfrperson_username'] }})</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

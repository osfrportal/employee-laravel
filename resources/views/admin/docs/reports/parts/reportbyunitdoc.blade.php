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
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Документ</th>
                <th scope="col">Работник</th>
                <th scope="col">Дата ознакомления</th>
                <th scope="col">Подпись</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($allDocsArray as $doc)
                @foreach ($doc->docPersonSigns as $person)
                    <tr>
                        <td>{{ $doc->docTypeName }} {{ $doc->docName }}</td>
                        <td>@dump($doc)</td>
                        <td>@dump($person)</td>
                        <td>@mdo</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection

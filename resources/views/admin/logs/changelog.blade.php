@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Логи</a></li>
                <li class="breadcrumb-item active">ChangeLog</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
<div class="my-3 p-3 bg-body rounded shadow-sm">

        <div class="d-flex text-muted pt-3 notifblock">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%"
                    fill="#007bff" dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <span class="d-block  mb-2">11-11-2023</span>
                <ul class="list-group list-group-flush small ">
                    <li class="list-group-item">[ADD] Добавлен столбец Группа документов в управление документами</li>
                  </ul>
            </div>
            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <span class="d-block  mb-2">08-11-2023</span>
                <ul class="list-group list-group-flush small ">
                    <li class="list-group-item">[ADD] В личном кабинете добавлено отображение количества документов, с которыми работник еще не ознакомился.</li>
                    <li class="list-group-item">[FIX] Исправлено отображение ведомости ознакомления и профиля работника в интерфейсе администратора. (ошибка в случае ознакомления рабоника УНЭПом)</li>
                    <li class="list-group-item">[TEST] Добавлены уведомления о синхронизации. (уведомления пользователям группы system-notifications)</li>
                    <li class="list-group-item">[ADD] Добавлено отображение списка сертификатов в базе.</li>
                  </ul>
            </div>
        </div>
</div>
@endsection
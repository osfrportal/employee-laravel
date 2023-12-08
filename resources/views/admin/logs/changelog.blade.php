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
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                    dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <span class="d-block  mb-2">08-12-2023</span>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item">
                        <i class="ti ti-code-plus icon-size-32" title="[ADD]"></i> Добавлено всплывающее уведомление
                        работникам о необходимости ознакомления с документами
                    </li>
                    <li class="list-group-item">
                        <i class="ti ti-code-plus icon-size-32" title="[ADD]"></i>В контактные данные работника добавлено
                        поле "Адрес VipNet" с отображением в телефонном справочнике
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex text-muted pt-3 notifblock">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                    dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <span class="d-block  mb-2">28-11-2023</span>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item">
                        <i class="ti ti-code-plus icon-size-32" title="[ADD]"></i> Добавлен отчет "Ведомость ознакомления
                        работников с нормативными документами"
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex text-muted pt-3 notifblock">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                    dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <span class="d-block  mb-2">21-11-2023</span>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item">
                        <i class="ti ti-code-asterix icon-size-32" title="[FIX]"></i> Исправлено отображение шрифта Montserrat в браузере Firefox (проверено на win10 firefox 120)
                    </li>
                    <li class="list-group-item">
                        <i class="ti ti-code-plus icon-size-32" title="[ADD]"></i> При просмотре списка работников и
                        профиля работника добавлено поле последняя активность на портале
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex text-muted pt-3 notifblock">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                    dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <span class="d-block  mb-2">20-11-2023</span>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item">
                        <i class="ti ti-code-asterix icon-size-32" title="[FIX]"></i> Портал переведен на использование корпоративного шрифта Montserrat
                    </li>
                    <li class="list-group-item">
                        <i class="ti ti-code-asterix icon-size-32" title="[FIX]"></i> Скрипты и стили перенесены на внутренний ресурс для ускорения загрузки
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex text-muted pt-3 notifblock">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                    dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <span class="d-block  mb-2">15-11-2023</span>
                <ul class="list-group list-group-flush small ">
                    <li class="list-group-item">
                        <i class="ti ti-code-plus icon-size-32" title="[ADD]"></i> Логи / Журнал обновления телефонного
                        справочника
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex text-muted pt-3 notifblock">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                    dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <span class="d-block  mb-2">11-11-2023</span>
                <ul class="list-group list-group-flush small ">
                    <li class="list-group-item">
                        <i class="ti ti-code-plus icon-size-32" title="[ADD]"></i> Добавлен столбец Группа документов в
                        управление документами
                    </li>

                    <li class="list-group-item">
                        <i class="ti ti-code-plus icon-size-32" title="[ADD]"></i> Добавлено журналирование в БД
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex text-muted pt-3 notifblock">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                    dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <span class="d-block  mb-2">08-11-2023</span>
                <ul class="list-group list-group-flush small ">
                    <li class="list-group-item">
                        <i class="ti ti-code-plus icon-size-32" title="[ADD]"></i> В личном кабинете добавлено
                        отображение количества документов, с которыми работник еще не ознакомился.
                    </li>
                    <li class="list-group-item">
                        <i class="ti ti-code-asterix icon-size-32" title="[FIX]"></i> Исправлено отображение ведомости ознакомления и профиля работника в
                        интерфейсе администратора. (ошибка в случае ознакомления рабоника УНЭПом)
                    </li>
                    <li class="list-group-item">
                        <i class="ti ti-code-dots icon-size-32" title="[TEST]"></i> Добавлены уведомления о синхронизации. (уведомления пользователям
                        группы system-notifications)
                    </li>
                    <li class="list-group-item">
                        <i class="ti ti-code-plus icon-size-32" title="[ADD]"></i> Добавлено отображение списка
                        сертификатов в базе.
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

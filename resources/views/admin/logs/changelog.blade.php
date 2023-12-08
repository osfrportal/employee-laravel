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
                    <li class="list-group-item ti ti-code-plus icon-size-32" title="[ADD]">
                        Добавлено всплывающее уведомление работникам о необходимости ознакомления с документами
                    </li>
                    <li class="list-group-item ti ti-code-plus icon-size-32" title="[ADD]">
                        В контактные данные работника добавлено поле "Адрес VipNet" с отображением в телефонном справочнике
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
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-plus" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 12h6" />
                            <path d="M12 9v6" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[ADD]</title>
                        </svg> Добавлен отчет "Ведомость ознакомления работников с нормативными документами"
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
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-asterix" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M12 11.875l3 -1.687" />
                            <path d="M12 11.875v3.375" />
                            <path d="M12 11.875l-3 -1.687" />
                            <path d="M12 11.875l3 1.688" />
                            <path d="M12 8.5v3.375" />
                            <path d="M12 11.875l-3 1.688" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[FIX]</title>
                        </svg> Исправлено отображение шрифта Montserrat в браузере Firefox (проверено на win10 firefox 120)
                    </li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-plus" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 12h6" />
                            <path d="M12 9v6" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[ADD]</title>
                        </svg> При просмотре списка работников и профиля работника добавлено поле последняя активность на
                        портале
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
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-asterix" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M12 11.875l3 -1.687" />
                            <path d="M12 11.875v3.375" />
                            <path d="M12 11.875l-3 -1.687" />
                            <path d="M12 11.875l3 1.688" />
                            <path d="M12 8.5v3.375" />
                            <path d="M12 11.875l-3 1.688" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[FIX]</title>
                        </svg> Портал переведен на использование корпоративного шрифта Montserrat
                    </li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-asterix" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M12 11.875l3 -1.687" />
                            <path d="M12 11.875v3.375" />
                            <path d="M12 11.875l-3 -1.687" />
                            <path d="M12 11.875l3 1.688" />
                            <path d="M12 8.5v3.375" />
                            <path d="M12 11.875l-3 1.688" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[FIX]</title>
                        </svg> Скрипты и стили перенесены на внутренний ресурс для ускорения загрузки
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
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-plus" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 12h6" />
                            <path d="M12 9v6" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[ADD]</title>
                        </svg> Логи / Журнал обновления телефонного справочника
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
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-plus" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 12h6" />
                            <path d="M12 9v6" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[ADD]</title>
                        </svg> Добавлен столбец Группа документов в управление документами
                    </li>

                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-plus" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 12h6" />
                            <path d="M12 9v6" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[ADD]</title>
                        </svg> Добавлено журналирование в БД
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
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-plus" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 12h6" />
                            <path d="M12 9v6" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[ADD]</title>
                        </svg> В личном кабинете добавлено отображение количества документов, с
                        которыми работник еще не ознакомился.
                    </li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-asterix" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M12 11.875l3 -1.687" />
                            <path d="M12 11.875v3.375" />
                            <path d="M12 11.875l-3 -1.687" />
                            <path d="M12 11.875l3 1.688" />
                            <path d="M12 8.5v3.375" />
                            <path d="M12 11.875l-3 1.688" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[FIX]</title>
                        </svg> Исправлено отображение ведомости ознакомления и профиля работника в
                        интерфейсе администратора. (ошибка в случае ознакомления рабоника УНЭПом)
                    </li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-dots" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M15 12h.01" />
                            <path d="M12 12h.01" />
                            <path d="M9 12h.01" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[TEST]</title>
                        </svg> Добавлены уведомления о синхронизации. (уведомления пользователям
                        группы system-notifications)
                    </li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-code-plus" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" title="[ADD]">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 12h6" />
                            <path d="M12 9v6" />
                            <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                            <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                            <title>[ADD]</title>
                        </svg> Добавлено отображение списка сертификатов в базе.
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

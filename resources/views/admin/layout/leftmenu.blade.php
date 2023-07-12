    <hr />
    <ul class="nav flex-column">
        <li class="nav-link">Административный раздел</li>
        <ul class="nav flex-column px-3">
            <div class="dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Работники</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item"
                            href="{{ route('osfrportal.admin.persons.all') }}">Просмотр/Управление</a></li>
                    <li><a class="dropdown-item" href="#">Кадровые перемещения</a></li>
                </ul>
            </div>
        </ul>
        <ul class="nav flex-column px-3">
            <div class="dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Доступ
                    на портал</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="{{ route('osfrportal.admin.roles') }}">Управление ролями
                            портала</a></li>
                    <li><a class="dropdown-item" href="{{ route('osfrportal.admin.permissions') }}">Управление
                            полномочиями портала</a></li>
                </ul>
            </div>
        </ul>
        <ul class="nav flex-column px-3">
            <div class="dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Конфигурация портала</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="{{ route('osfrportal.admin.sysconfig.all') }}">Основные
                            настройки</a></li>
                </ul>
            </div>
        </ul>
        <ul class="nav flex-column px-3">
            <div class="dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Ссылки на ресурсы</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="#">Ссылки</a></li>
                    <li><a class="dropdown-item" href="#">Группы ссылок</a></li>
                </ul>
            </div>
        </ul>
        <ul class="nav flex-column px-3">
            <div class="dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Телефонный справочник</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="{{ route('osfrportal.admin.phone.units') }}">Подразделения</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('osfrportal.admin.phone.addresses') }}">Адреса</a></li>
                    <li><a class="dropdown-item" href="{{ route('osfrportal.admin.phone.dialplan') }}">DialPlan</a></li>
                </ul>
            </div>
        </ul>
        <ul class="nav flex-column px-3">
            <div class="dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">ИС и полномочия</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="#">Управление</a></li>
                </ul>
            </div>
        </ul>
        <ul class="nav flex-column px-3">
            <div class="dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Логи</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="#">Системные</a></li>
                    <li><a class="dropdown-item" href="#">Обновление телефонного справочника</a></li>
                    <li><a class="dropdown-item" href="#">AD входы на ПК</a></li>
                    <li><a class="dropdown-item" href="#">СКУД логи проходов</a></li>
                </ul>
            </div>
        </ul>
        <ul class="nav flex-column px-3">
            <div class="dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Документы</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="{{ route('osfrportal.admin.docs.all') }}">Управление</a></li>
                    <li><a class="dropdown-item" href="{{ route('osfrportal.admin.docs.groups.all') }}">Разделы</a></li>
                    <li><a class="dropdown-item" href="{{ route('osfrportal.admin.docs.types.all') }}">Типы
                            документов</a></li>
                    <li><a class="dropdown-item" href="#">Отчеты</a></li>
                </ul>
            </div>
        </ul>
    </ul>

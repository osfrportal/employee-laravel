@can('admin-menu-show')
    <hr />
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link {{ active_link('osfrportal.admin.dashboard') }}"
                href="{{ route('osfrportal.admin.dashboard') }}">Административный раздел</a></li>
        @canany(['person-view', 'person-manage'])
            <ul class="nav flex-column px-3">
                <div class="dropend">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Работники</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        @can('person-view')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.persons.all') }}">Просмотр/Управление</a>
                            </li>
                        @endcan
                        @can('personmovements-view')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.persons.movements.all') }}">Кадровые
                                    перемещения</a></li>
                        @endcan
                    </ul>
                </div>
            </ul>
        @endcanany
        @canany(['stamps-manage', 'skd-manage', 'certs-manage', 'crypto-manage', 'flash-manage', 'tokens-manage'])
            <ul class="nav flex-column px-3">
                <div class="dropend">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Бизнес ресурсы</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        @can('stamps-manage')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.stamps.all') }}"><i
                                        class="ti ti-disk"></i> Металлические печати</a></li>
                        @endcan
                        @can('flash-manage')
                            <li><a class="dropdown-item" href="#">Устройства хранения данных</a></li>
                        @endcan
                        @can('tokens-manage')
                            <li><a class="dropdown-item" href="#">JaCarta/RuToken</a></li>
                        @endcan
                        @can('certs-manage')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.certs.all') }}">Электронные подписи</a>
                            </li>
                        @endcan
                        @can('crypto-manage')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.crypto.index') }}"><i
                                        class="ti ti-shield"></i> Криптосредства</a></li>
                        @endcan
                        @can('skd-manage')
                            <li><a class="dropdown-item" href="#">СКУД</a></li>
                        @endcan
                    </ul>
                </div>
            </ul>
        @endcanany
        @canany(['portal-access-roles', 'portal-access-groups', 'portal-access-users'])
            <ul class="nav flex-column px-3">
                <div class="dropend">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Доступ
                        на портал</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        @can('portal-access-roles')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.roles') }}">Управление ролями
                                    портала</a></li>
                        @endcan
                        @can('portal-access-groups')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.permissions') }}">Управление
                                    полномочиями портала</a></li>
                        @endcan
                    </ul>
                </div>
            </ul>
        @endcanany
        @can('sysconfig-manage')
            <ul class="nav flex-column px-3">
                <div class="dropend">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Конфигурация портала</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="{{ route('osfrportal.admin.sysconfig.all') }}">Основные
                                настройки</a></li>
                        <li><a class="dropdown-item" href="{{ route('osfrportal.admin.mainterance.index') }}">Обслуживание</a>
                        </li>
                    </ul>
                </div>
            </ul>
        @endcan
        @can('links-manage')
            <ul class="nav flex-column px-3">
                <div class="dropend">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Ссылки на ресурсы</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="{{ route('osfrportal.admin.links.all') }}">Ссылки</a></li>
                        <li><a class="dropdown-item" href="{{ route('osfrportal.admin.links.groups.all') }}">Группы
                                ссылок</a></li>
                    </ul>
                </div>
            </ul>
        @endcan
        @can('phone-manage')
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
        @endcan
        @canany(['infosystem-view', 'infosystem-manage'])
            <ul class="nav flex-column px-3">
                <div class="dropend">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">ИС и полномочия</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="{{ route('osfrportal.admin.infosystems.index') }}">Управление</a>
                        </li>
                    </ul>
                </div>
            </ul>
        @endcanany
        @canany(['logs-ad', 'logs-sys', 'logs-skd', 'logs-phone'])
            <ul class="nav flex-column px-3">
                <div class="dropend">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Логи</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        @can('logs-sys')
                            <li><a class="dropdown-item" href="#">Системные</a></li>
                        @endcan
                        @can('logs-phone')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.logs.logsphoneupdates') }}">Обновление
                                    телефонного справочника</a></li>
                        @endcan
                        @can('logs-ad')
                            <li><a class="dropdown-item" href="#">AD входы на ПК</a></li>
                        @endcan
                        @can('logs-skd')
                            <li><a class="dropdown-item" href="#">СКУД логи проходов</a></li>
                        @endcan
                        <li><a class="dropdown-item" href="{{ route('osfrportal.admin.logs.changelog') }}">ChangeLog</a></li>

                    </ul>
                </div>
            </ul>
        @endcanany
        @canany(['docs-view', 'docs-manage'])
            <ul class="nav flex-column px-3">
                <div class="dropend">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Документы</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        @can('docs-view')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.docs.all') }}">Управление</a></li>
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.docs.reports.all') }}">Отчеты</a></li>
                        @endcan
                        @can('docs-manage')
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.docs.groups.all') }}">Разделы</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('osfrportal.admin.docs.types.all') }}">Типы
                                    документов</a></li>
                        @endcan

                    </ul>
                </div>
            </ul>
        @endcanany
    </ul>
@endcan

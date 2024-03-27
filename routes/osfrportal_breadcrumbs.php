<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use Osfrportal\OsfrportalLaravel\Models\SfrAppointment;

//https://github.com/diglactic/laravel-breadcrumbs


Breadcrumbs::for('osfrportal.mainpage', function (BreadcrumbTrail $trail): void {
    $trail->push('Главная страница', route('osfrportal.mainpage'));
});


/**
 * Административный раздел
 */
Breadcrumbs::for('osfrportal.admin', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.mainpage');
    $trail->push('Администрирование', route('osfrportal.admin.dashboard'));
});
Breadcrumbs::for('osfrportal.admin.dashboard', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.mainpage');
    $trail->push('Администрирование', route('osfrportal.admin.dashboard'));
});
/**
 * Администрирование
 * Работники
 */
Breadcrumbs::for('osfrportal.admin.persons', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('Работники');
});


Breadcrumbs::for('osfrportal.admin.persons.movements.all', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('Кадровые перемещения', route('osfrportal.admin.persons.movements.all'));
});
Breadcrumbs::for('osfrportal.admin.persons.appointments.all', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('Настройка должностей', route('osfrportal.admin.persons.appointments.all'));
});
Breadcrumbs::for('osfrportal.admin.persons.appointments.detail', function (BreadcrumbTrail $trail, $aid): void {
    $appointment = SfrAppointment::where('aid', $aid)->first();

    $trail->parent('osfrportal.admin.persons.appointments.all');
    $trail->push($appointment->aname, route('osfrportal.admin.persons.appointments.detail', $aid));
});

Breadcrumbs::for('osfrportal.admin.persons.all', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.persons');
    $trail->push('Просмотр, управление', route('osfrportal.admin.persons.all'));
});

Breadcrumbs::for('osfrportal.admin.persons.show.all', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.persons');
    $trail->push('Просмотр, управление v2', route('osfrportal.admin.persons.show.all'));
});

Breadcrumbs::for('osfrportal.admin.persons.detail', function (BreadcrumbTrail $trail, $personname): void {
    $trail->parent('osfrportal.admin.persons.all');
    $trail->push($personname);
});

/**
 * Администрирование
 * Логи
 */
Breadcrumbs::for('osfrportal.admin.logs', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('Логи');
});

Breadcrumbs::for('osfrportal.admin.logs.changelog', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.logs');
    $trail->push('Changelog');
});

Breadcrumbs::for('osfrportal.admin.logs.logsphoneupdates', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.logs');
    $trail->push('Журнал обновления телефонного справочника');
});
/**
 * Администрирование
 * Криптосредства
 */
Breadcrumbs::for('osfrportal.admin.crypto.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('Криптосредства', route('osfrportal.admin.crypto.index'));
});
Breadcrumbs::for('osfrportal.admin.crypto.detail', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.crypto.index');
    $trail->push('Подробная информация');
});
Breadcrumbs::for('osfrportal.admin.crypto.new', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.crypto.index');
    $trail->push('Добавление криптосредства');
});
/**
 * Администрирование
 * Устройства хранения данных
 */
Breadcrumbs::for('osfrportal.admin.storage.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('Устройства хранения данных', route('osfrportal.admin.storage.index'));
});
Breadcrumbs::for('osfrportal.admin.storage.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.storage.index');
    $trail->push('Добавление устройства хранения', route('osfrportal.admin.storage.create'));
});
/**
 * Администрирование
 * Конфигурация портала
 */
Breadcrumbs::for('osfrportal.admin.sysconfig', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('Основные настройки', route('osfrportal.admin.sysconfig.all'));
});
Breadcrumbs::for('osfrportal.admin.mainterance.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('Обслуживание', route('osfrportal.admin.mainterance.index'));
});
/**
 * Администрирование
 * Информационные системы
 */

Breadcrumbs::for('osfrportal.admin.infosystems', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('ИС и полномочия');
});

Breadcrumbs::for('osfrportal.admin.infosystems.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.infosystems');
    $trail->push('Управление', route('osfrportal.admin.infosystems.index'));
});

Breadcrumbs::for('osfrportal.admin.infosystems.add', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.infosystems.index');
    $trail->push('Добавление ИС', route('osfrportal.admin.infosystems.add'));
});

Breadcrumbs::for('osfrportal.admin.infosystems.roles.add', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.infosystems.index');
    $trail->push('Добавление ролей для ИС', route('osfrportal.admin.infosystems.roles.add'));
});

/**
 * Администрирование
 * Документы
 */
Breadcrumbs::for('osfrportal.admin.docs.all', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('Управление документами', route('osfrportal.admin.docs.all'));
});
Breadcrumbs::for('osfrportal.admin.docs.reports.all', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.docs.all');
    $trail->push('Отчеты', route('osfrportal.admin.docs.reports.all'));
});
Breadcrumbs::for('osfrportal.admin.docs.reports.byunits', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.docs.reports.all');
    $trail->push('Ознакомление по подразделениям', route('osfrportal.admin.docs.reports.byunits'));
});
/**
 * Пользовательский раздел
 */
Breadcrumbs::for('osfrportal.phone.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.mainpage');
    $trail->push('Телефонный справочник', route('osfrportal.phone.index'));
});

Breadcrumbs::for('osfrportal.phone.editform', function (BreadcrumbTrail $trail, $personname): void {
    $trail->parent('osfrportal.phone.index');
    $trail->push($personname);
    $trail->push('Редактирование контактной информации');
});


Breadcrumbs::for('osfrportal.dashboard', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.mainpage');
    $trail->push('Личный кабинет', route('osfrportal.dashboard'));
});

Breadcrumbs::for('osfrportal.profile.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.dashboard');
    $trail->push('Профиль', route('osfrportal.profile.index'));
});

Breadcrumbs::for('osfrportal.profile.usbskdcerts', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.dashboard');
    $trail->push('Бизнес-ресурсы', route('osfrportal.profile.usbskdcerts'));
});

Breadcrumbs::for('osfrportal.docs.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.dashboard');
    $trail->push('Документы для ознакомления', route('osfrportal.docs.index'));
});

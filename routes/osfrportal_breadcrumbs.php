<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('osfrportal.mainpage', function (BreadcrumbTrail $trail): void {
    $trail->push('Главная страница', route('osfrportal.mainpage'));
});


/**
 * Административный раздел
 */
Breadcrumbs::for('osfrportal.admin', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.mainpage');
    $trail->push('Администрирование');
});


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
 * Пользовательский раздел
 */
Breadcrumbs::for('osfrportal.phone.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.mainpage');
    $trail->push('Телефонный справочник', route('osfrportal.phone.index'), ['iconclass' => 'bi bi-telephone']);
});

Breadcrumbs::for('osfrportal.phone.editform', function (BreadcrumbTrail $trail, $personid): void {
    $trail->parent('osfrportal.phone.index');
    $trail->push('Редактирование контактной информации', route('osfrportal.phone.editform', $personid));
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
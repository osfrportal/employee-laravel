<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('osfrportal.admin', function (BreadcrumbTrail $trail): void {
    $trail->push('Администрирование');
});

Breadcrumbs::for('osfrportal.admin.infosystems', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin');
    $trail->push('ИС и полномочия');
});

Breadcrumbs::for('osfrportal.admin.infosystems.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('osfrportal.admin.infosystems');
    $trail->push('Управление', route('osfrportal.admin.infosystems.index'));
});
<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('osfrportal.admin.infosystems.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Информационные системы', route('osfrportal.admin.infosystems.index'));
});
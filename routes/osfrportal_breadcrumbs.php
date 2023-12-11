<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.infosystems.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Информационные системы', route('admin.infosystems.index'));
});
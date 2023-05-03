<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\PermissionsController;

//'prefix' => 'api/osfr/v1/osfrportal/admin',
//'name' => 'osfrapi.osfrportal.admin.'

/**
 * Административные маршруты
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('select2')->name('select2.')->group(function () {
        Route::prefix('permissions')->name('permissions.')->controller(PermissionsController::class)->group(function () {
            Route::get('/roles', 'APISelect2ShowRolesList')->name('roles_all');
            Route::get('/permissions', 'APISelect2ShowPermissionsList')->name('permissions_all');
        });
    });
    Route::controller(PermissionsController::class)->group(function () {
        Route::get('/roles', 'APIShowRolesList')->name('roles_all');
        Route::get('/permissions', 'APIShowPermissionsList')->name('permissions_all');
    });
});


//'prefix' => 'api/osfr/v1/osfrportal',
//'name' => 'osfrapi.osfrportal.'


Route::get('/', function () {
    return [];
})->name('index');
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\PermissionsController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRPersonController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\PhoneController;
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
        Route::get('/roles/users/{roleid}', 'APIShowRoleUsersList')->name('role_users_all');
        Route::get('/roles', 'APIShowRolesList')->name('roles_all');
        Route::get('/permissions/users/{permissionid}', 'APIShowPermissionUsersList')->name('permission_users_all');
        Route::get('/permissions', 'APIShowPermissionsList')->name('permissions_all');
    });
    Route::prefix('persons')->name('persons.')->group(function () {
        Route::controller(SFRPersonController::class)->group(function () {
            Route::get('/all', 'APIPersonsList')->name('all');
        });
    });
});


//'prefix' => 'api/osfr/v1/osfrportal',
//'name' => 'osfrapi.osfrportal.'

Route::prefix('phone')->name('phone.')->group(function () {
    Route::controller(PhoneController::class)->group(function () {
        Route::get('/all', 'apiPhonesData')->name('all')->middleware('cacheResponse:30000');
    });
});

Route::get('/', function () {
    return [];
})->name('index');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\PermissionsController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRPersonController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRPhoneAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRDocsAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFROtrsAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\PhoneController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRApiController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRCertsAdminController;

//'prefix' => 'api/osfr/v1/osfrportal/admin',
//'name' => 'osfrapi.osfrportal.admin.'

/**
 * Административные маршруты
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('orion')->name('orion.')->group(function () {
        Route::controller(SFRApiController::class)->group(function () {
            Route::get('/card/{cardid}/accesspoints', 'apiGetAccessPointsByCardId')->name('card.accesspoints');
        });
    });
    Route::prefix('crypto')->name('crypto.')->group(function () {
        Route::controller(SFRApiController::class)->group(function () {
            Route::get('/', 'apiCryptoListAll')->name('all');
        });
    });



    Route::prefix('otrs')->name('otrs.')->group(function () {
        Route::controller(SFROtrsAdminController::class)->group(function () {
            Route::get('/stats/{otrs_graph_unit}', 'APIStatsOut')->name('stats');
        });
    });

    Route::prefix('select2')->name('select2.')->group(function () {
        Route::prefix('permissions')->name('permissions.')->controller(PermissionsController::class)->group(function () {
            Route::get('/roles', 'APISelect2ShowRolesList')->name('roles_all');
            Route::get('/permissions', 'APISelect2ShowPermissionsList')->name('permissions_all');
        });
        Route::prefix('docs')->name('docs.')->controller(SFRDocsAdminController::class)->group(function () {
            Route::get('/groups', 'apiSelect2ShowDocsGroups')->name('groups_all');
            Route::get('/types', 'apiSelect2ShowDocsTypes')->name('types_all');
        });
        Route::prefix('units')->name('units.')->controller(SFRApiController::class)->group(function () {
            Route::get('/', 'apiSelect2UnitsAll')->name('all');
        });
        Route::prefix('docs')->name('docs.')->controller(SFRApiController::class)->group(function () {
            Route::get('/detail/type/{typeid}', 'apiSelect2DocTypeByID')->name('detail.type.byid');
            Route::get('/detail/group/{groupid}', 'apiSelect2DocGroupByID')->name('detail.group.byid');
            Route::get('/allgrouped', 'apiSelect2DocsGroupedAll')->name('allgrouped');
        });
        Route::prefix('infosystems')->name('infosystems.')->controller(SFRApiController::class)->group(function () {
            Route::get('/detail/{isysid}', 'apiSelect2InfosystemByID')->name('detail.byid');
            Route::get('/allgrouped', 'apiSelect2InfosystemsGroupedAll')->name('allgrouped');

        });
        Route::prefix('persons')->name('persons.')->controller(SFRApiController::class)->group(function () {
            Route::get('/search/{query}', 'apiSelect2PersonsList')->name('search');
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
    Route::prefix('phone')->name('phone.')->group(function () {
        Route::controller(SFRPhoneAdminController::class)->group(function () {
            Route::get('/addr', 'APIAddrList')->name('addresses');
        });
    });
    Route::controller(SFRDocsAdminController::class)->name('docs.')->prefix('docs')->group(function () {
        Route::name('groups.')->prefix('groups')->group(function () {
            Route::get('/short', 'apiGroupsShortShow')->name('short');
            Route::get('/', 'apiGroupsShow')->name('all');
        });
        Route::name('types.')->prefix('types')->group(function () {
            Route::get('/', 'apiTypesShow')->name('all');
        });
        Route::get('/', 'apiDocsShow')->name('all');
    });
});


//'prefix' => 'api/osfr/v1/osfrportal',
//'name' => 'osfrapi.osfrportal.'

Route::prefix('phone')->name('phone.')->group(function () {
    Route::controller(PhoneController::class)->group(function () {
        Route::get('/all', 'apiPhonesData')->name('all');
    });
});

Route::get('/', function () {
    return [];
})->name('index');

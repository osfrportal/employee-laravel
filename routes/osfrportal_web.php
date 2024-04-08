<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
//use Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Http\Controllers\LoginController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SfrDocsController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRx509Controller;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFROrionController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRIpController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\PermissionsController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRSysconfigController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRPersonController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRPhoneAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRDocsAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRCertsAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRCryptoAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRMainteranceAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRStampsAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRLinksAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRLogsAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFROtrsAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRInfoSystemsController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRAdminDashboardController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRStorageController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRRcaImportController;
use Illuminate\Support\Facades\Storage;

/**
 * Административные маршруты
 */
Route::middleware(['auth.osfrportal'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(SFRCryptoAdminController::class)->name('crypto.')->prefix('crypto')->group(function () {
        Route::get('/new', 'addCryptoForm')->name('new');

        Route::get('/view/{cryptouuid}', 'showDetailedInfo')->name('detail');
        Route::post('/save/detail', 'cryptoSaveDetail')->name('detail.save');
        Route::post('/save/new', 'cryptoSaveNew')->name('new.save');
        Route::post('/deleteperson', 'cryptoRemovePerson')->name('person.remove');
        Route::post('/delete', 'removeCrypto')->name('delete');
        Route::get('/', 'cryptoShowList')->name('index');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRMainteranceAdminController::class)->name('mainterance.')->prefix('mainterance')->group(function () {
        Route::get('/', 'mainteranceIndex')->name('index');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRRcaImportController::class)->name('rcaimport.')->prefix('rcaimport')->group(function () {
        Route::get('/appointments', 'runAppointmentsImport')->name('appointments');
        Route::get('/units', 'runUnitsImport')->name('units');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRStorageController::class)->name('storage.')->prefix('storage')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/', 'index')->name('index');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRInfoSystemsController::class)->name('infosystems.')->prefix('infosystems')->group(function () {
        Route::post('/save', 'saveInfoSystem')->name('save');
        Route::get('/add', 'showAddForm')->name('add');
        Route::get('/view/parent/{isysid}', 'showDetailedInfoParent')->name('view.parent');
        Route::get('/view/child/{isysid}', 'showDetailedInfoChild')->name('view.child');
        Route::get('/roles/add', 'showRolesAddForm')->name('roles.add');
        Route::post('/roles/save', 'saveInfoSystemRoles')->name('roles.save');
        Route::get('/', 'listInfoSystemsAll')->name('index');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFROtrsAdminController::class)->name('otrs.')->prefix('otrs')->group(function () {
        Route::view('/', 'osfrportal::admin.extsystems.otrsgraph')->name('all');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRLogsAdminController::class)->name('logs.')->prefix('logs')->group(function () {
        Route::get('/phoneupdates', 'logsPhoneUpdates')->name('logsphoneupdates');
        Route::get('/changelog/add', 'changelogAddForm')->name('changelog.add');
        Route::post('/changelog/save', 'changelogSaveNew')->name('changelog.save');
        Route::get('/changelog', 'changelogIndex')->name('changelog');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRSysconfigController::class)->name('sysconfig.')->prefix('sysconfig')->group(function () {
        Route::post('/save', 'saveConfigList')->name('save');
        Route::get('/', 'showConfigList')->name('all');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRCertsAdminController::class)->name('certs.')->prefix('certs')->group(function () {
        Route::get('/api/all', 'apiCertsListAll')->name('api.all')->middleware(['auth.osfrportal']);
        Route::get('/', 'certsShowList')->name('all')->middleware(['auth.osfrportal']);
    });

    Route::controller(SFRLinksAdminController::class)->name('links.')->prefix('links')->group(function () {
        Route::get('/api/select2/groups/{selectedGroupID?}', 'apiSelect2GroupsAll')->name('api.select2.groups.all');
        Route::get('/api/select2/groups/root/{selectedGroupID?}', 'apiSelect2GroupsRoot')->name('api.select2.groups.root');
        Route::get('/edit/{linkid}', 'linkEdit')->name('edit');
        Route::get('/delete/{linkid}', 'linkDelete')->name('delete');
        Route::get('/add', 'linkAdd')->name('add');
        Route::post('/save', 'linkSave')->name('save');
        Route::get('/', 'linksShow')->name('all');

        Route::get('/groups/add', 'linksGroupsAdd')->name('groups.add');
        Route::get('/groups/edit/{groupid}', 'linksGroupsEdit')->name('groups.edit');
        Route::get('/groups/delete/{groupid}', 'linksGroupsDelete')->name('groups.delete');
        Route::post('/groups/save', 'groupSave')->name('groups.save');
        Route::get('/groups', 'linksGroupsShow')->name('groups.all');
    })->middleware(['permission:links-manage']);

    Route::controller(SFRStampsAdminController::class)->name('stamps.')->prefix('stamps')->group(function () {
        Route::get('/api/journal', 'apiJournalAll')->name('api.journal');
        Route::get('/api/all', 'apiStampsListAll')->name('api.all');
        Route::post('/save', 'saveStamp')->name('stampsave');
        Route::post('/issue', 'issueStamp')->name('stampissue');
        Route::post('/return', 'returnStamp')->name('stampreturn');
        Route::get('/journal', 'stampsJournalShow')->name('journal');
        Route::get('/', 'stampsShowList')->name('all');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRPhoneAdminController::class)->name('phone.')->prefix('phone')->group(function () {
        Route::get('/addr', 'ShowAddrList')->name('addresses');
        Route::get('/dialplan/edit/{dpid}', 'EditDialPlan')->name('dialplan.edit');
        Route::get('/dialplan/delete/{dpid}', 'DeleteDialPlan')->name('dialplan.delete');
        Route::get('/dialplan/add', 'AddDialPlan')->name('dialplan.add');
        Route::post('/dialplan/save', 'SaveDialPlan')->name('dialplan.save');
        Route::get('/dialplan', 'ShowDialPlanList')->name('dialplan');
        Route::post('/units/save', 'updateUnit')->name('units.save');
        Route::get('/units', 'ShowUnitsList')->name('units');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRPersonController::class)->name('persons.')->prefix('persons')->group(function () {
        Route::get('/movements/all', 'movementsAllShow')->name('movements.all');
        Route::get('/appointments/all', 'appointmentsAllShow')->name('appointments.all');
        Route::get('/appointments/detail/{aid}', 'appointmentShow')->name('appointments.detail');
        Route::post('/appointments/detail/save', 'appointmentSave')->name('appointments.detail.save');
        Route::post('/appointments/detail/delete', 'appointmentDelete')->name('appointments.detail.delete');
        Route::post('/resetpassword', 'sendRandPassword')->name('resetpassword');
        Route::get('/detail/{personid}', 'ShowPersonDetail')->name('detail');
        Route::get('/print/docssigns/{personid}', 'genDocsSignListPrint')->name('print.docs.signlist');
        Route::get('/', 'ShowPersonsList')->name('all');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRDocsAdminController::class)->name('docs.')->prefix('docs')->group(function () {
        Route::get('/detail/{docid}', 'docsShowDetail')->name('detail');
        Route::get('/add', 'docsAddForm')->name('add');
        Route::post('/add', 'docsAdd')->name('save');
        Route::post('/savedateend', 'docsSaveDateEnd')->name('savedateend');
        Route::post('/saveeditable', 'docsSaveEditable')->name('saveeditable');
        Route::post('/deleteeditable', 'docsDeleteEditable')->name('deleteeditable');
        Route::get('/', 'docsShowList')->name('all');
        Route::name('types.')->prefix('types')->group(function () {
            Route::get('/detail/{typeid}', 'typesShowDetail')->name('detail');
            Route::get('/add', 'typesAddForm')->name('add');
            Route::post('/save', 'typesSave')->name('save');
            Route::get('/', 'typesShowList')->name('all');
        })->middleware(['auth.osfrportal']);
        Route::name('groups.')->prefix('groups')->group(function () {
            Route::get('/detail/{groupid}', 'groupsShowDetail')->name('detail');
            Route::get('/add', 'groupsAddForm')->name('add');
            Route::post('/save', 'groupsSave')->name('save');
            Route::get('/', 'groupsShowList')->name('all');
        })->middleware(['auth.osfrportal']);
        Route::name('reports.')->prefix('reports')->group(function () {
            Route::get('/byunits', 'reportsShowByUnits')->name('byunits');
            Route::post('/byunits', 'reportsMakeByUnits')->name('byunits');
            Route::get('/', 'reportsShowList')->name('all');
        })->middleware(['auth.osfrportal']);
    })->middleware(['auth.osfrportal']);
    Route::controller(PermissionsController::class)->prefix('permissions')->group(function () {
        Route::post('/role/add', 'AddRole')->name('permissions.addrole');
        Route::get('/role/edit/{roleid}', 'EditRole')->name('permissions.editrole');
        Route::get('/role/delete/{roleid}', 'DeleteRole')->name('permissions.deleterole');
        Route::get('/role/showusers/{roleid}', 'ShowRoleUsersList')->name('permissions.showroleusers');
        Route::get('/role', 'ShowRolesList')->name('roles');

        Route::get('/permission/showusers/{permissionid}', 'ShowPermissionUsersList')->name('permissions.showpermissionusers');
        Route::post('/permission/add', 'AddPermission')->name('permissions.addpermission');
        Route::get('/permission', 'ShowPermissionsList')->name('permissions');
    })->middleware(['auth.osfrportal']);

    Route::controller(SFRAdminDashboardController::class)->group(function () {
        Route::get('/', 'showDashboard')->name('dashboard');
    })->middleware(['auth.osfrportal']);
});




Route::controller(LoginController::class)->group(function () {
    Route::get('/restorepass', 'showRestorePassForm')->name('restorepass');
    Route::post('/restorepass', 'doRestorePass')->name('dorestorepass');
    Route::get('/login', 'showloginform')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(SFRIpController::class)->group(function () {
    Route::get('/showmyip', 'ipIndex')->name('showmyip');
});

Route::middleware(['auth.osfrportal'])->group(function () {
    Route::controller(PhoneController::class)->prefix('phone')->name('phone.')->group(function () {
        Route::get('/edit/{personid}', 'phoneShowEditForm')->name('editform')->middleware(['auth.osfrportal']);
        Route::get('/export/xlsx', 'exportPhonesToXLSX')->name('export.xlsx')->middleware(['auth.osfrportal', 'can:export-phones-pd']);
        Route::get('/export/vipnet/xlsx', 'exportPhonesToXLSXWithVipNet')->name('export.vipnet.xlsx')->middleware(['auth.osfrportal', 'can:export-phones-pd']);
        Route::post('/save', 'doUpdateContacts')->name('save')->middleware(['auth.osfrportal']);
        Route::get('/', 'phoneIndex')->name('index');
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboardIndex')->name('dashboard');
        Route::get('/dashboard2', 'dashboardIndex2')->name('dashboard2');
        Route::post('/notifications/read', 'markNotificationRead')->name('markNotificationRead');
    });
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::post('/passchange', 'passwordChange')->name('passchange');
        Route::get('/usbskdcers', 'profileUsbSkdCerts')->name('usbskdcerts');
        Route::get('/print/docssigns', 'genDocsSignListPrint')->name('print.docs.signlist');
        Route::get('/', 'profileIndex')->name('index');
    });
    Route::controller(SfrDocsController::class)->prefix('docs')->name('docs.')->group(function () {
        Route::get('/sign/xml/{docid}/{fileid}', 'apiGenXMLtoSign')->name('xmltosign');
        Route::post('/sign/add', 'apiSaveUKEPSignToDB')->name('saveSignUKEP');
        Route::post('/sign/addunep', 'apiSaveUNEPSign')->name('saveSignUNEP');
        Route::get('/detail/{docid}', 'docsCard')->name('detail');
        Route::get('/', 'docsIndex')->name('index');
    });
});


//Route::name('osfrportal.')->group(function () {


Route::get('/parsexml', function () {

    $string = Storage::disk('local')->get('000_20230504employee.xml');
    $xml = @simplexml_load_string(data: $string, options: LIBXML_NOCDATA);
    $out = json_decode(json: json_encode((array) $xml, flags: JSON_UNESCAPED_UNICODE), flags: JSON_UNESCAPED_UNICODE);
    $out1 = collect($out->Person);
    $out1->each(function ($person) {
        $fio = sprintf('%s %s %s <br>', $person->lastname, $person->firstname, $person->middlename);
        print ($fio);
    });
});
Route::get('/orion', function () {
    $ctrl = new SFROrionController;
    $ctrl->test();
});

Route::get('/ddconfig', function () {
    //dump(Auth::user()->SfrPerson);
    dd(config());
});
Route::get('/testnotification', function () {

    Auth::user()->notify(new Osfrportal\OsfrportalLaravel\Notifications\NewDocs);
});
Route::get('/test', function () {
    $pperson = SfrPerson::where('psnils', '12413082809')->first();
    $sfruser = new SfrUser;
    $sfruser->username = 'PleshkovPA';
    $sfruser->password = bcrypt('12345');
    $sfruser->pid = $pperson->pid;
    $sfruser->save();
});

Route::get('/assign-itstaff', function () {
    Auth::user()->assignRole('it-staff');
    dump('DONE');
});

Route::get('/x509test', [SFRx509Controller::class, 'parceX509certs']);

Route::get('/', function () {
    return view('osfrportal::sections.mainpage.show');
})->name('mainpage');

Route::fallback(function (Request $req) {
    return redirect()->route('osfrportal.mainpage');
});
//});

<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
//use Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Http\Controllers\LoginController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRImapReaderController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRx509Controller;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\PermissionsController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRSysconfigController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRPersonController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRPhoneAdminController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\SFRDocsAdminController;
use Illuminate\Support\Facades\Storage;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRUkepController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRUnepController;
use Spatie\ResponseCache\Facades\ResponseCache;

/**
 * Административные маршруты
 */
Route::prefix('admin')->name('admin.')->middleware(['auth.osfrportal', 'doNotCacheResponse'])->group(function () {
    Route::controller(SFRSysconfigController::class)->name('sysconfig.')->prefix('sysconfig')->group(function () {
        Route::post('/save', 'saveConfigList')->name('save');
        Route::get('/', 'showConfigList')->name('all');
    });
    Route::controller(SFRPhoneAdminController::class)->name('phone.')->prefix('phone')->group(function () {
        Route::get('/addr', 'ShowAddrList')->name('addresses');
        Route::get('/dialplan/edit/{dpid}', 'EditDialPlan')->name('dialplan.edit');
        Route::get('/dialplan/delete/{dpid}', 'DeleteDialPlan')->name('dialplan.delete');
        Route::get('/dialplan/add', 'AddDialPlan')->name('dialplan.add');
        Route::post('/dialplan/save', 'SaveDialPlan')->name('dialplan.save');
        Route::get('/dialplan', 'ShowDialPlanList')->name('dialplan');
        Route::post('/units/save', 'updateUnit')->name('units.save');
        Route::get('/units', 'ShowUnitsList')->name('units');
    });
    Route::controller(SFRPersonController::class)->name('persons.')->prefix('persons')->group(function () {
        Route::get('/', 'ShowPersonsList')->name('all');
    });
    Route::controller(SFRDocsAdminController::class)->name('docs.')->prefix('docs')->group(function () {
        Route::get('/detail/{docid}', 'docsShowDetail')->name('detail');
        Route::get('/add', 'docsAddForm')->name('add');
        Route::post('/add', 'docsAdd')->name('add');
        Route::get('/', 'docsShowList')->name('all');
        Route::name('types.')->prefix('types')->group(function () {
            Route::get('/detail/{typeid}', 'typesShowDetail')->name('detail');
            Route::get('/add', 'typesAddForm')->name('add');
            Route::post('/save', 'typesSave')->name('save');
            Route::get('/', 'typesShowList')->name('all');
        });
        Route::name('groups.')->prefix('groups')->group(function () {
            Route::get('/detail/{groupid}', 'groupsShowDetail')->name('detail');
            Route::get('/add', 'groupsAddForm')->name('add');
            Route::post('/save', 'groupsSave')->name('save');
            Route::get('/', 'groupsShowList')->name('all');
        });
    });
    Route::controller(PermissionsController::class)->prefix('permissions')->group(function () {
        Route::post('/role/add', 'AddRole')->name('permissions.addrole');
        Route::get('/role/edit/{roleid}', 'EditRole')->name('permissions.editrole');
        Route::get('/role/delete/{roleid}', 'DeleteRole')->name('permissions.deleterole');
        Route::get('/role/showusers/{roleid}', 'ShowRoleUsersList')->name('permissions.showroleusers');
        Route::get('/role', 'ShowRolesList')->name('roles');

        Route::get('/permission/showusers/{permissionid}', 'ShowPermissionUsersList')->name('permissions.showpermissionusers');
        Route::post('/permission/add', 'AddPermission')->name('permissions.addpermission');
        Route::get('/permission', 'ShowPermissionsList')->name('permissions');
    });
});




Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showloginform')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(PhoneController::class)->prefix('phone')->name('phone.')->group(function () {
    Route::get('/edit/{personid}', 'phoneShowEditForm')->name('editform')->middleware(['auth.osfrportal', 'doNotCacheResponse']);
    Route::post('/save', 'doUpdateContacts')->name('save')->middleware(['auth.osfrportal', 'doNotCacheResponse']);
    Route::get('/', 'phoneIndex')->name('index')->middleware('cacheResponse:30000');
});

Route::middleware(['auth.osfrportal', 'doNotCacheResponse'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboardIndex')->name('dashboard');
    });
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/usbskdcers', 'profileUsbSkdCerts')->name('usbskdcerts');
        Route::get('/', 'profileIndex')->name('index');
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
        print($fio);
    });
});

Route::middleware('doNotCacheResponse')->get('/xmlpki', function () {
    $sxe = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="no" ?><Envelope xmlns="urn:envelope"></Envelope>');
    $xml_body = $sxe->addChild('Body');
    $xml_data = $xml_body->addChild('Data');
    $xml_data->addAttribute('xml:id', 'dataToSign');
    $xml_data->addChild('portalUser', Auth::user()->username);
    $xml_data->addChild('portalPersonUUID', Auth::user()->pid);
    $xml_data->addChild('docSignName', 'Mr. Parser');
    $xml_data->addChild('docSignFileUUID', 'Mr. Parser');
    $xml_data->addChild('docSignHashGOST', 'Mr. Parser');
    $xml_data->addChild('docSignTimestamp', 'Mr. Parser');
    $current = $sxe->asXML();
    $current = strtr($current, array("\n" => ''));
    echo $current;
});
Route::middleware('doNotCacheResponse')->get('/ddconfig', function () {
    dump(Auth::user()->SfrPerson);
    dd(config());
});

Route::middleware('doNotCacheResponse')->get('/test', function () {
    ResponseCache::clear();
    //$size = Storage::disk('ftp1c')->size('vacation_058 (TXT) 2023-05-26.txt');
    //dump($size);
    //dump(Auth::user()->SfrPerson->getPersonVacationNow());

    $pperson = SfrPerson::where('psnils', '12413082809')->first();
    $sfruser = new SfrUser;
    $sfruser->username = 'PleshkovPA';
    $sfruser->password = bcrypt('12345');
    $sfruser->pid = $pperson->pid;
    $sfruser->save();
});
Route::middleware('doNotCacheResponse')->get('/certstest', [SFRUkepController::class, 'test']);

Route::middleware('doNotCacheResponse')->get('/x509test', [SFRx509Controller::class, 'parceX509certs']);

Route::get('/', function () {
    //dd(config('auth'));
    /*
    $to_name = 'Paul';
    $to_email = 'pleshkovpa@48.sfr.gov.ru';
    $data = array('name' => "Sam Jose", "body" => "Test mail");
    Mail::send('osfrportal::emails.emails', $data, function ($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)->subject('Artisans Web Testing Mail');
    });
    */
    return view('osfrportal::sections.mainpage.show');
})->name('mainpage');
//});

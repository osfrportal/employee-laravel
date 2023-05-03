<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
//use Mail;
use Illuminate\Support\Facades\Route;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Http\Controllers\LoginController;
use Osfrportal\OsfrportalLaravel\Http\Controllers\Admin\PermissionsController;

/**
 * Административные маршруты
 */
Route::prefix('admin')->name('admin.')->middleware('auth.osfrportal')->group(function () {
    Route::controller(PermissionsController::class)->prefix('permissions')->group(function () {
        Route::post('/role/add', 'AddRole')->name('permissions.addrole');
        Route::get('/role/edit/{roleid}', 'EditRole')->name('permissions.editrole');
        Route::get('/role/delete/{roleid}', 'DeleteRole')->name('permissions.deleterole');
        Route::get('/role/showusers/{roleid}', 'ShowRoleUsers')->name('permissions.showroleusers');
        Route::get('/role', 'ShowRolesList')->name('roles');

        Route::get('/permission/showusers/{permissionid}', 'ShowPermissionUsers')->name('permissions.showpermissionusers');
        Route::get('/permission', 'ShowPermissionsList')->name('permissions');
    });
});




Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showloginform')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});
//Route::name('osfrportal.')->group(function () {
Route::get('/dashboard', function () {
    return view('osfrportal::sections.dashboard.dashboard');
})->name('dashboard')->middleware('auth.osfrportal');

Route::get('/createuser', function () {
    $pperson = SfrPerson::where('psnils', '12413082809')->first();

    $sfruser = new SfrUser;
    $sfruser->username = 'PleshkovPA';
    $sfruser->password = bcrypt('12345');
    $sfruser->pid = $pperson->pid;
    $sfruser->save();
});
Route::get('/', function () {
    /*
    $to_name = 'Paul';
    $to_email = 'pleshkovpa@48.sfr.gov.ru';
    $data = array('name'=>"Sam Jose", "body" => "Test mail");
    Mail::send('osfrportal::emails.emails', $data, function($message) use ($to_name, $to_email) {
    $message->to($to_email, $to_name)->subject('Artisans Web Testing Mail');
    });
    */
    return view('osfrportal::sections.mainpage.show');
})->name('mainpage');
//});

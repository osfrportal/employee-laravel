<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRIpController;

Route::controller(SFRIpController::class)->group(function () {
    Route::match (['get', 'post'], '/uloginip', 'storeDataFromPC');
});



Route::get('/', function () {
    return redirect('https://start.0058.pfr.ru/showmyip');
});

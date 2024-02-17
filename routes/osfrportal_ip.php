<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\ResponseCache\Facades\ResponseCache;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRIpController;

//Route::middleware('doNotCacheResponse')->get('/', [SFRIpController::class, 'ipIndex']);

Route::middleware('doNotCacheResponse')->controller(SFRIpController::class)->group(function () {
    Route::match(['get', 'post'], '/uloginip', 'storeDataFromPC');
});



Route::middleware('doNotCacheResponse')->get('/', function () {
    return redirect('https://start.0058.pfr.ru/showmyip');
});

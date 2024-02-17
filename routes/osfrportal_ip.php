<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\ResponseCache\Facades\ResponseCache;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRIpController;

//Route::middleware('doNotCacheResponse')->get('/', [SFRIpController::class, 'ipIndex']);

Route::fallback(function (Request $req) {
    return redirect()->route('osfrportal.showmyip');
});

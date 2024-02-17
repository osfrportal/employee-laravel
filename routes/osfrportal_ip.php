<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\ResponseCache\Facades\ResponseCache;


Route::middleware('doNotCacheResponse')->get('/', function () {
    //dump(Auth::user()->SfrPerson);
    dd('test ip.0058.pfr.ru');
});

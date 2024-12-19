<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewHomeController;
use App\Http\Controllers\StoreAPIKeyController;

Route::get('/', ViewHomeController::class)->name('home');
Route::post('/information', StoreAPIKeyController::class)->name('store.apikey');

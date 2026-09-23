<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Route::get('/', function () {
        //     return 'ADMIN WORKING';
        // })->name('index');

        Route::get('/', [LoginController::class, 'index'])->name('index');
    });

<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('web')->group(function () {

    Route::get('/', [LoginController::class, 'index'])->name('index');
});

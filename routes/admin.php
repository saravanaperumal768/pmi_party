<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Login page
        Route::get('/', [LoginController::class, 'index'])
            ->name('index');

        // Login AJAX
        Route::post('/login', [LoginController::class, 'login'])
            ->name('login.submit');

        // Dashboard
        Route::get('/dashboard', [LoginController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/registration_details/{memberid}', [LoginController::class, 'registrationdetails'])
            ->name('registration_details');



          Route::get('/logout', [LoginController::class, 'logout'])
            ->name('logout');
    });

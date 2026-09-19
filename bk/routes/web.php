<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PmiRegistrationController;
use App\Models\pmi_registration;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/member-register', [IndexController::class, 'member_register'])->name('member-register');

// Route::get('/member-register', [PmiRegistrationController::class, 'member_register'])
//     ->name('member.register');

Route::post('/member-register', [PmiRegistrationController::class, 'store'])
    ->name('pmi.registration.store');

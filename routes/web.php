<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LanguageController;
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

Route::get('/about_us', [IndexController::class, 'about_us'])->name('about_us');



Route::get('/member-register', [IndexController::class, 'member_register'])->name('member-register');

// Route::get('/member-register', [PmiRegistrationController::class, 'member_register'])
//     ->name('member.register');
Route::post('/member-register', [PmiRegistrationController::class, 'store'])
    ->name('pmi.registration.store');

Route::get('/get-const/{district_id}', [IndexController::class, 'getConst']);
Route::get('/get-taluk/{district_id}', [IndexController::class, 'getTaluk']);
Route::get('/get-block/{district_id}', [IndexController::class, 'getBlock']);


Route::get('/language/{lang}', [LanguageController::class, 'change'])
    ->name('language.change');

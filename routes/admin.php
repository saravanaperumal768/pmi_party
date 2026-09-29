<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MembercardController;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [LoginController::class, 'index'])
            ->name('index');

        Route::get('/member_login', [LoginController::class, 'member_login'])
            ->name('member_login');

        // Login AJAX
        Route::post('/login', [LoginController::class, 'login'])
            ->name('login.submit');

        Route::post('/login_member', [LoginController::class, 'login_member'])
            ->name('login_member.submit');

        Route::get('/refresh-captcha/{type}', [AdminController::class, 'refreshCaptcha'])
            ->name('refresh.captcha');
        Route::middleware('auth')->group(function () {
            // Login page


            // Dashboard
            Route::get('/dashboard', [LoginController::class, 'dashboard'])
                ->name('dashboard');

            Route::get('/dashboard_member', [LoginController::class, 'dashboard_member'])
                ->name('dashboard_member');


            Route::get('/assign_role', [AdminController::class, 'assign_role'])
                ->name('assign_role');

            Route::get('/registration_details/{memberid}', [LoginController::class, 'registrationdetails'])
                ->name('registration_details');

            Route::post('/admin/approve-member', [AdminController::class, 'approveMember'])
                ->name('approve_member');

            //  --------Assign roles------------
            Route::post('/assign-role/update', [AdminController::class, 'updateAssignRole'])
                ->name('assign.role.update');

            Route::get('/get-districts-by-region/{region_id}', [AdminController::class, 'getDistrictsByRegion'])
                ->name('get.districts.by.region');

            Route::get(
                '/get-taluks-by-district/{district_code}',
                [AdminController::class, 'getTaluksByDistrict']
            )->name('get.taluks.by.district');


            Route::get(
                '/get-blocks-by-district/{district_code}',
                [AdminController::class, 'getBlocksByDistrict']
            )->name('get.blocks.by.district');

            Route::get(
                '/get-designations-by-level/{level}',
                [AdminController::class, 'getDesignationsByLevel']
            )->name('get.designations.by.level');

            // -------------party incharge------------
            Route::get('/party_incharge', [AdminController::class, 'party_incharge'])
                ->name('party_incharge');

            // --------Approved Members------------
            Route::get('/approvedmembers', [AdminController::class, 'approvedmembers'])
                ->name('approvedmembers');



            // Route::get('/membercard', [AdminController::class, 'membercard'])
            //     ->name('membercard');
            // ----------reports---------

             Route::get('/reports', [LoginController::class, 'reports'])
                ->name('reports');


                   Route::get('/total_register', [ExportController::class, 'total_register'])
                ->name('total_register');



            Route::get(
                '/member-card/{memberid}',
                [MembercardController::class, 'generatePDF']
            )->name('member.card');

            Route::get('/logout', [LoginController::class, 'logout'])
                ->name('logout');


            Route::get(
                '/export-members',
                [ExportController::class, 'exportPostingMembers']
            )->name('export.members');


             Route::get(
                '/export-incharges',
                [ExportController::class, 'exportinchargesMembers']
            )->name('export.incharges');
        });
    });

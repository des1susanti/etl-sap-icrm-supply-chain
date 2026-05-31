<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ReconciliationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

// REVISI DI SINI: Menonaktifkan middleware 'active' sementara untuk pengujian login
Route::middleware(['auth'])->group(function () {

    /*
    |----------------------------------------------------------------------
    | DASHBOARD
    |----------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index']);


    /*
    |----------------------------------------------------------------------
    | UPLOAD DATA
    |----------------------------------------------------------------------
    */

    Route::prefix('upload')->name('upload.')->group(function () {

        Route::get('/', [UploadController::class, 'index'])
            ->name('index');

        Route::post('/sap', [UploadController::class, 'uploadSAP'])
            ->name('sap');

        Route::post('/icrm', [UploadController::class, 'uploadICRM'])
            ->name('icrm');

        Route::get('/logs', [UploadController::class, 'logs'])
            ->name('logs');

        Route::delete('/{id}', [UploadController::class, 'destroy'])
            ->name('destroy');
    });


 /*
|--------------------------------------------------------------------------
| RECONCILIATION
|--------------------------------------------------------------------------
*/

Route::prefix('reconciliation')->name('reconciliation.')->group(function () {

    Route::get('/', [ReconciliationController::class, 'index'])
        ->name('index');

    Route::get('/create', [ReconciliationController::class, 'create'])
        ->name('create');

    Route::post('/', [ReconciliationController::class, 'store'])
        ->name('store');

    Route::get('/export', [ReconciliationController::class, 'exportExcel'])
        ->name('export');

    /*
    |--------------------------------------------------------------------------
    | EDIT & UPDATE
    |--------------------------------------------------------------------------
    */

    Route::get('/{id}/edit', [ReconciliationController::class, 'edit'])
        ->name('edit');

    Route::put('/{id}', [ReconciliationController::class, 'update'])
        ->name('update');

    /*
    |--------------------------------------------------------------------------
    | EXPORT DETAIL
    |--------------------------------------------------------------------------
    */

    Route::get('/{id}/export', [ReconciliationController::class, 'exportDetail'])
        ->name('export.detail');

    /*
    |--------------------------------------------------------------------------
    | SHOW DETAIL
    |--------------------------------------------------------------------------
    */

    Route::get('/{id}', [ReconciliationController::class, 'show'])
        ->name('show');

    /*
    |--------------------------------------------------------------------------
    | PROCESS & APPROVE
    |--------------------------------------------------------------------------
    */

    Route::post('/{id}/process', [ReconciliationController::class, 'process'])
        ->name('process');

    Route::post('/{id}/approve', [ReconciliationController::class, 'approve'])
        ->middleware('role:manager')
        ->name('approve');

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    Route::delete('/{id}', [ReconciliationController::class, 'destroy'])
        ->name('destroy');
});
    /*
    |----------------------------------------------------------------------
    | PROFILE (semua role bisa akses)
    |----------------------------------------------------------------------
    */

    Route::prefix('profile')->name('profile.')->group(function () {

        Route::get('/', [ProfileController::class, 'index'])
            ->name('index');

        Route::put('/', [ProfileController::class, 'update'])
            ->name('update');

        Route::put('/password', [ProfileController::class, 'updatePassword'])
            ->name('password');

        Route::post('/avatar', [ProfileController::class, 'updateAvatar'])
            ->name('avatar');
    });


    /*
    |----------------------------------------------------------------------
    | USER MANAGEMENT (hanya manager)
    |----------------------------------------------------------------------
    */

    Route::prefix('users')
        ->name('users.')
        ->middleware('role:manager')
        ->group(function () {

        Route::get('/', [UserController::class, 'index'])
            ->name('index');

        Route::get('/create', [UserController::class, 'create'])
            ->name('create');

        Route::post('/', [UserController::class, 'store'])
            ->name('store');

        Route::get('/{id}/edit', [UserController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}', [UserController::class, 'update'])
            ->name('update');

        Route::delete('/{id}', [UserController::class, 'destroy'])
            ->name('destroy');

        Route::patch('/{id}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('toggle-status');
    });


    /*
    |----------------------------------------------------------------------
    | SETTINGS (hanya manager)
    |----------------------------------------------------------------------
    */

    Route::prefix('settings')
        ->name('settings.')
        ->middleware('role:manager')
        ->group(function () {

        Route::get('/', [SettingController::class, 'index'])
            ->name('index');

        Route::put('/', [SettingController::class, 'update'])
            ->name('update');
    });

});
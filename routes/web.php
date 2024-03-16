<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpedisiController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\MobilAssetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, "login"])->name('login');
    Route::post('/login', [AuthController::class, "dologin"])->name('dologin');
    Route::get('/forgot', [AuthController::class, "forgot"])->name('forgot');
    Route::post('/forgot-password', [AuthController::class, "forget_mail"])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, "reset_password"])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, "update_password"])->name('password.update');
});



Route::middleware(['auth:web'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
    // Mobil
    Route::get('/car', [MobilController::class, "index"])->name('mobil');
    Route::get('/car/list', [MobilController::class, 'get_mobil'])->name('mobil.list');
    Route::post('/car/create', [MobilController::class, "store"])->name('mobil.create');
    Route::post('/car/edit', [MobilController::class, "edit"])->name('mobil.edit');
    Route::post('/car/update', [MobilController::class, "update"])->name('mobil.update');
    Route::put('/car/update/status/{id}', [MobilController::class, "status_update"])->name('status.update');
    Route::put('/car/update/unggulan/{id}', [MobilController::class, "unggulan_update"])->name('unggulan.update');
    Route::post('/car/delete', [MobilController::class, "destroy"])->name('mobil.delete');
    // Kontak
    Route::get('/kontak/{id}', [KontakController::class, "index"])->name('kontak');
    Route::put('/kontak/update/{id}', [KontakController::class, "update"])->name('kontak.update');
    // User Management
    Route::get('/user-management', [UserController::class, "index"])->name('user');
    Route::get('/user-management/list', [UserController::class, 'get_user'])->name('user.list');
    Route::post('/user-management/create', [UserController::class, "store"])->name('user.create');
    Route::post('/user-management/edit', [UserController::class, "edit"])->name('user.edit');
    Route::post('/user-management/update', [UserController::class, "update"])->name('user.update');
    Route::post('/user-management/delete', [UserController::class, "destroy"])->name('user.delete');
    //
    Route::get('/expedisi/{slug}', [ExpedisiController::class, "index"])->name('expedisi');
    Route::post('/expedisi/update', [ExpedisiController::class, "update"])->name('expedisi.update');
    // Log Activity
    Route::get('/log-activity', [LogActivityController::class, "index"])->name('log');
    Route::get('/log-activity/list', [LogActivityController::class, 'get_log'])->name('log.list');
    // Logout
    Route::get('/logout', [AuthController::class, "logout"])->name('logout');
});

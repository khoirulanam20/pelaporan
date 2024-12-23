<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\{
    BerandaController,
    DashboardController,
    AuthController,
    InsidenController,
    NoRMController,
    RuanganController,
    UserController,
};
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

Route::get('/', [BerandaController::class, 'guestIndex'])->name('guest.index');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN routes
Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('insiden', InsidenController::class);
    Route::resource('no_rm', NoRMController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('user', UserController::class);
    Route::post('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
    Route::get('/insiden/export', [InsidenController::class, 'export'])->name('insiden.export');
    Route::post('/dashboard/reset-filter', [DashboardController::class, 'resetFilter'])->name('dashboard.reset-filter');
    Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.getData');
});

Route::group(['middleware' => ['role:admin,user']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
    Route::get('/insiden/export', [InsidenController::class, 'export'])->name('insiden.export');
    Route::post('/dashboard/reset-filter', [DashboardController::class, 'resetFilter'])->name('dashboard.reset-filter');
    Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.getData');
});

// Route::get('/', [BerandaController::class, 'guestIndex'])->name('guest.index');
Route::post('/guest', [BerandaController::class, 'guestStore'])->name('guest.store');
Route::get('/insiden/export', [DashboardController::class, 'exportPDF'])->name('insiden.export');
Route::get('/dashboard/export', [DashboardController::class, 'exportPDF'])->name('dashboard.export');
Route::get('/dashboard/export-word', [DashboardController::class, 'exportWord'])->name('dashboard.export-word');
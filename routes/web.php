<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportAdminController;
use App\Http\Controllers\ReportController;
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

Route::resource('/', HomeController::class);
Route::resource('/register', RegistrationController::class);

Route::get('apply/{slug}', [RegistrationController::class, 'showBySlug'])->name('register.showBySlug');





Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute untuk menangani proses login
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('intern', InternController::class);

    Route::resource('position', PositionController::class);
    Route::resource('periode', PeriodeController::class);
    Route::get('/admin/profile', [ProfileController::class, 'admin'])->name('admin.profile');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin']);
    Route::put('/admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');;
    Route::get('/intern/download/{id}', [InternController::class, 'download'])->name('intern.download');
    Route::post('/intern/restore/{id}', [InternController::class, 'restore'])->name('intern.restore');
    Route::delete('/intern/force-delete/{id}', [InternController::class, 'forceDelete'])->name('intern.forceDelete');
    Route::post('/position/restore/{id}', [PositionController::class, 'restore'])->name('position.restore');
    Route::delete('/position/force-delete/{id}', [PositionController::class, 'forceDelete'])->name('position.forceDelete');

    // Route::get('report/admin', [ReportAdminController::class, 'index'])->name('report.admin.index');
    Route::get('/getPeriodeId/{positionId}', [InternController::class, 'getPeriodeId']);

    Route::get('/admin/report', [ReportAdminController::class, 'index'])->name('admin.report.index');
    Route::get('/admin/intern/{id}', [ReportAdminController::class, 'getInternsByPeriode'])->name('admin.intern.periode');
    Route::get('/admin/daily/{id}', [ReportAdminController::class, 'getReportByIntern'])->name('admin.report.intern');
    Route::post('/admin/report/verify/{id}', [ReportAdminController::class, 'verifyReport'])->name('admin.report.verify');
    Route::get('/admin/report/status',  [ReportAdminController::class, 'getStatus'])->name('admin.report.status');

    
});

Route::middleware(['auth'])->group(function () {
    
});

Route::middleware(['auth', 'user'])->group(function () {
    // Route::get('/user/dashboard', [DashboardController::class, 'user']);
    Route::resource('/reports', ReportController::class);
    Route::get('/profile', [ProfileController::class, 'user'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'updateUser'])->name('profile.update');
    // Route::get('/user/report', function () {
    //     return view('pages.user.report');
    // });
});

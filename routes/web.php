<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegistrationController;
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

Route::resource('/', RegistrationController::class);


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute untuk menangani proses login
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');;

// Route::resource('intern', InternController::class);
// Route::resource('position', PositionController::class);
// Route::resource('user', UserController::class);



Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
    // Route::resource('timetable', TimeTableController::class);
    Route::get('/admin/profile', [ProfileController::class, 'admin'])->name('admin.profile');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin']);
    Route::put('/admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');;
    Route::get('/intern/download/{id}', [InternController::class, 'download'])->name('intern.download');
    Route::post('/intern/restore/{id}', [InternController::class, 'restore'])->name('intern.restore');

    Route::post('/position/restore/{id}', [PositionController::class, 'restore'])->name('position.restore');

    // Route::get('/report', function () {
    //     return view('pages.admin.report.index');
    // });
});

Route::middleware(['auth'])->group(function () {
    Route::resource('intern', InternController::class);

    Route::resource('position', PositionController::class);
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'user']);
    Route::get('/profile', [ProfileController::class, 'user'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'updateUser'])->name('profile.update');
    Route::get('/user/report', function () {
        return view('pages.user.report');
    });
});

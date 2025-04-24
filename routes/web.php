<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(['auth', 'admin','shareAdminData'])->group(function () {
    Route::get('/users/approve', [UserController::class, 'showApprovalList'])->name('admin.users.approve.list');
    Route::patch('/users/{user}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
    Route::delete('/users/{user}/reject', [UserController::class, 'reject'])->name('admin.users.reject');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class, ['names' => 'admin.users']);
    // Các route admin khác
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::post('/admins/update', [AdminController::class, 'update'])->name('admin.admins.update');

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LearningFeatureController;
use App\Http\Controllers\PlanController;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('process.login');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/{id}', [UserController::class, 'view'])->name('users.view');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/search', [AdminController::class, 'search'])->name('admins.search');
    Route::get('/admins/add', [AdminController::class, 'add'])->name('admins.add');
    Route::get('/admins/{id}', [AdminController::class, 'view'])->name('admins.view');
    Route::post('/admins/store', [AdminController::class, 'store'])->name('admins.store');
    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

    Route::get('/edit-profile', [AccountController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('account.update-profile');

    Route::get('/change-password', [AccountController::class, 'changePassword'])->name('change-password');
    Route::post('/update-change-password', [AccountController::class, 'updatePassword'])->name('account.update_change_password');

    Route::get('/storage/{imageName}', [AccountController::class, 'getImage'])->name('image');

    Route::get('/learning-features', [LearningFeatureController::class, 'index'])->name('learning-features.index');
    Route::get('/learning-features/search', [LearningFeatureController::class, 'search'])->name('learning-features.search');
    Route::get('/learning-features/add', [LearningFeatureController::class, 'add'])->name('learning-features.add');
    Route::get('/learning-features/{id}', [LearningFeatureController::class, 'view'])->name('learning-features.view');
    Route::get('/learning-features/edit/{id}', [LearningFeatureController::class, 'edit'])->name('learning-features.edit');
    Route::post('/learning-features/store', [LearningFeatureController::class, 'store'])->name('learning-features.store');
    Route::put('/learning-features/store/{id}', [LearningFeatureController::class, 'storeEdit'])->name('learning-features.store-edit');
    Route::delete('/learning-features/{id}', [LearningFeatureController::class, 'destroy'])->name('learning-features.destroy');
    
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::get('/plans/add', [PlanController::class, 'add'])->name('plans.add');
    Route::get('/plans/{id}', [PlanController::class, 'view'])->name('plans.view');
    Route::get('/plans/edit/{id}', [PlanController::class, 'edit'])->name('plans.edit');
    Route::post('/plans/store', [PlanController::class, 'store'])->name('plans.store');
    Route::put('/plans/store/{id}', [PlanController::class, 'storeEdit'])->name('plans.store-edit');
    Route::delete('/plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
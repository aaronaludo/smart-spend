<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\AccountController;
use App\Http\Controllers\Mobile\ExpenseController;
use App\Http\Controllers\Mobile\IncomeController;
use App\Http\Controllers\Mobile\OverviewController;
use App\Http\Controllers\Mobile\GraphController;;
use App\Http\Controllers\Mobile\MonthlyController;
use App\Http\Controllers\Mobile\NotificationController;
use App\Http\Controllers\Mobile\LearningFeatureController;
use App\Http\Controllers\Mobile\PlanController;
use App\Http\Controllers\Mobile\UserPlanController;
use App\Http\Controllers\Mobile\RiskAssessmentController;

Route::prefix('users')->group(function () {
    Route::get('/test', [AuthController::class, 'test'])->name('users.test');
    Route::post('/login', [AuthController::class, 'login'])->name('users.login');
    Route::post('/register', [AuthController::class, 'register'])->name('users.register');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('users')->group(function () {
        Route::get('/index', [AuthController::class, 'index'])->name('users.index');

        Route::get('/overview', [OverviewController::class, 'index'])->name('users.overview.index');

        Route::post('/edit-profile', [AccountController::class, 'editProfile'])->name('users.edit-profile');
        Route::post('/change-password', [AccountController::class, 'changePassword'])->name('users.change-password');

        Route::get('/expenses', [ExpenseController::class, 'index'])->name('users.expenses.index');
        Route::post('/expenses/add', [ExpenseController::class, 'add'])->name('users.expenses.add');
        Route::put('/expenses/{id}', [ExpenseController::class, 'edit'])->name('users.expenses.edit');
        Route::delete('/expenses/{id}', [ExpenseController::class, 'delete'])->name('users.expenses.delete');

        Route::get('/incomes', [IncomeController::class, 'index'])->name('users.incomes.index');
        Route::post('/incomes/add', [IncomeController::class, 'add'])->name('users.incomes.add');
        Route::put('/incomes/{id}', [IncomeController::class, 'edit'])->name('users.incomes.edit');
        Route::delete('/incomes/{id}', [IncomeController::class, 'delete'])->name('users.incomes.delete');

        Route::get('/monthly', [MonthlyController::class, 'index'])->name('users.graph.index');
        Route::get('/graph/create_budget', [GraphController::class, 'create_budget'])->name('users.graph.create_budget');

        Route::get('/notifications', [NotificationController::class, 'index'])->name('users.notifications.index');

        Route::get('/learning-features', [LearningFeatureController::class, 'index'])->name('users.learning-features.index');
        
        Route::get('/plans', [PlanController::class, 'index'])->name('users.plans.index');
        
        Route::post('/user-plan/add', [UserPlanController::class, 'add'])->name('users.user-plan.add');
        Route::delete('/user-plan/{id}', [UserPlanController::class, 'delete'])->name('users.user-plan.delete');

        Route::get('/risk-assessments', [RiskAssessmentController::class, 'index'])->name('users.risk-assessments.index');

        Route::post('/risk-assessments/add', [RiskAssessmentController::class, 'add'])->name('users.risk-assessments.add');
        
        Route::get('/logout', [AuthController::class, 'logout'])->name('users.logout');
    });
});
<?php

// use App\Http\Controllers\Employee\ActivityColleagueController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VacancyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApplicantsController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\EmployeeActivitiesController;
use App\Http\Controllers\Employee\DailyActivitiesController;
use App\Http\Controllers\Employee\Auth\EmployeeAuthController;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Employee\DailyActivityColleagueController;
use App\Http\Controllers\Employee\Auth\EmployeeSettingsController;

// Admin Login Routes
Route::prefix('admin')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.auth.login');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Employee Activities Route
        Route::get('employee/{id}/activities', [EmployeeActivitiesController::class, 'show'])->name('admin.employees.activities');

        // Employee Management Routes
        Route::prefix('employee')->name('admin.employee.')->group(function () {
            Route::get('/list', [EmployeeController::class, 'index'])->name('list');
            Route::get('/add', [EmployeeController::class, 'add'])->name('add');
            Route::post('/create', [EmployeeController::class, 'create'])->name('create');
            Route::delete('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
            Route::post('/update', [EmployeeController::class, 'update'])->name('update');
            Route::get('/show/{id}', [EmployeeController::class, 'show'])->name('show');
            Route::get('/{id}/work_view', [EmployeeController::class, 'showWork'])->name('work_view');
        });

        // Task Routes
        Route::prefix('tasks')->name('admin.task.')->group(function () {
            Route::get('/list', [TaskController::class, 'index'])->name('list');
            Route::get('/add', [TaskController::class, 'add'])->name('add');
            Route::post('/create', [TaskController::class, 'create'])->name('create');
            Route::post('/delete', [TaskController::class, 'delete'])->name('delete');
            Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('edit');
            Route::post('/update', [TaskController::class, 'update'])->name('update');
        });

        // Vacancy Routes
        Route::prefix('vacancies')->name('admin.vacancy.')->group(function () {
            Route::get('/', [VacancyController::class, 'index'])->name('list');
            Route::get('/create', [VacancyController::class, 'add'])->name('create');
            Route::post('/', [VacancyController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [VacancyController::class, 'edit'])->name('edit');
            Route::put('/{id}', [VacancyController::class, 'update'])->name('update');
            Route::delete('/{id}', [VacancyController::class, 'delete'])->name('delete');
        });

        // Applicants Routes
        Route::prefix('applicants')->name('admin.applicants.')->group(function () {
            Route::get('/', [ApplicantsController::class, 'index'])->name('index');
            Route::get('/create', [ApplicantsController::class, 'create'])->name('create');
            Route::post('/store', [ApplicantsController::class, 'store'])->name('store');
            Route::delete('/{id}/delete', [ApplicantsController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/reply', [ApplicantsController::class, 'reply'])->name('reply');
        });

        // Admin CRUD Routes
        Route::prefix('admins')->name('admin.admin.')->group(function () {
            Route::get('/list', [AdminController::class, 'index'])->name('list');
            Route::get('/add', [AdminController::class, 'add'])->name('add');
            Route::post('/store', [AdminController::class, 'store'])->name('store');
            Route::post('/delete', [AdminController::class, 'delete'])->name('delete');
            Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
            Route::post('/update', [AdminController::class, 'update'])->name('update');
        });
    });
});



Route::prefix('employee')->group(function () {
    Route::get('login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
    Route::post('login', [EmployeeAuthController::class, 'login']);
    Route::post('logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');

    // Routes for employee password reset
    Route::get('password/reset', [EmployeeAuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('password/email', [EmployeeAuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [EmployeeAuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [EmployeeAuthController::class, 'reset'])->name('password.update');

    Route::middleware('auth:employee')->group(function () {
        Route::get('account-settings', [EmployeeSettingsController::class, 'edit'])->name('employee.auth.accountsettings');
        Route::put('account-settings', [EmployeeSettingsController::class, 'update'])->name('employee.auth.accountsettings.update');
        Route::get('dailyactivities/{id}/download', [DailyActivitiesController::class, 'download'])->name('dailyactivities.download');

        // Daily Activities Routes
        Route::get('dailyactivities', [DailyActivitiesController::class, 'index'])->name('dailyactivities.index');
        Route::get('dailyactivities/create', [DailyActivitiesController::class, 'create'])->name('dailyactivities.create');
        Route::post('dailyactivities', [DailyActivitiesController::class, 'store'])->name('dailyactivities.store');
        Route::get('dailyactivities/{id}/edit', [DailyActivitiesController::class, 'edit'])->name('dailyactivities.edit');
        Route::put('dailyactivities/{id}', [DailyActivitiesController::class, 'update'])->name('dailyactivities.update');
        Route::delete('dailyactivities/{id}', [DailyActivitiesController::class, 'destroy'])->name('dailyactivities.destroy');
        Route::post('dailyactivitiesColleauge/{id}/update', [DailyActivityColleagueController::class, 'updateStatus'])->name('dailyactivitiesColleauge.update');

        // Dashboard Route
        Route::get('dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');

        // Additional Routes
        Route::get('dailyactivities/{id}/status', [DailyActivitiesController::class, 'status'])->name('dailyactivities.status');
        Route::get('dailyactivities/{id}/action', [DailyActivitiesController::class, 'action'])->name('dailyactivities.action');
        Route::get('dailyactivities/{id}/transfer', [DailyActivitiesController::class, 'showTransferForm'])->name('dailyactivities.transfer');
        Route::put('dailyactivities/{id}/transfer', [DailyActivitiesController::class, 'transfer'])->name('task.transfer');
        // routes/web.php
        Route::get('dailyactivities/{id}/update-work', [DailyActivitiesController::class, 'updateWorkForm'])->name('dailyactivities.worklist');

        Route::post('dailyactivities/uploadwork', [DailyActivitiesController::class, 'storework'])->name('dailyactivities.store.worklist');


        Route::get('/dailyactivities/{id}/show', [DailyActivitiesController::class, 'showworklist'])->name('dailyactivities.show');

        // Edit the showwork list
        Route::get('/dailyactivities/{id}/edit', [DailyActivitiesController::class, 'editworklist'])->name('dailyactivities.edit');

        Route::get('/dailyactivities/{id}/update', [DailyActivitiesController::class, 'updateworklist'])->name('dailyactivities.update');

        // routes/web.php
    });
});

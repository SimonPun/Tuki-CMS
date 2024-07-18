<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VacancyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApplicantsController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Employee\DailyActivitiesController;
use App\Http\Controllers\Employee\Auth\EmployeeAuthController;
use App\Http\Controllers\Employee\EmployeeDashboardController;

// Admin Login Routes
Route::prefix('admin')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.auth.login');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Employee Routes
        Route::prefix('employee')->name('admin.')->group(function () {
            Route::get('/list', [EmployeeController::class, 'index'])->name('employee.list');
            Route::get('/add', [EmployeeController::class, 'add'])->name('employee.add');
            Route::post('/create', [EmployeeController::class, 'create'])->name('employee.create');
            Route::post('/delete', [EmployeeController::class, 'delete'])->name('employee.delete');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
            Route::post('/update', [EmployeeController::class, 'update'])->name('employee.update');
            Route::get('/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
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
        });

        // Admin CRUD Routes
        Route::prefix('admin')->name('admin.admin.')->group(function () {
            Route::get('/list', [AdminController::class, 'index'])->name('list');
            Route::get('/add', [AdminController::class, 'add'])->name('add');
            Route::post('/store', [AdminController::class, 'store'])->name('store');
            Route::post('/delete', [AdminController::class, 'delete'])->name('delete');
            Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
            Route::post('/update', [AdminController::class, 'update'])->name('update');
        });
    });
});

// Employee Login Routes
Route::prefix('employee')->group(function () {
    Route::get('login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
    Route::post('login', [EmployeeAuthController::class, 'login']);
    Route::post('logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');

    Route::middleware('auth:employee')->group(function () {
        // Daily Activities Routes
        Route::get('dailyactivities', [DailyActivitiesController::class, 'index'])->name('dailyactivities.index');
        Route::get('dailyactivities/create', [DailyActivitiesController::class, 'create'])->name('dailyactivities.create');
        Route::post('dailyactivities', [DailyActivitiesController::class, 'store'])->name('dailyactivities.store');
        Route::get('dailyactivities/{id}/edit', [DailyActivitiesController::class, 'edit'])->name('dailyactivities.edit');
        Route::put('dailyactivities/{id}', [DailyActivitiesController::class, 'update'])->name('dailyactivities.update');
        Route::delete('dailyactivities/{id}', [DailyActivitiesController::class, 'destroy'])->name('dailyactivities.destroy');

        // Dashboard Route
        Route::get('dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
    });
});

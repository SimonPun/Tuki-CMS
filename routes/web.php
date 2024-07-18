<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApplicantsController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\VacancyController;
use Illuminate\Support\Facades\Route;




Route::prefix('admin')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        // Admin Login Routes
        Route::get('/login', [LoginController::class, 'index'])->name('admin.auth.login');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
        Route::middleware(['auth:admin'])->group(function () {
            // Admin Logout Route
        });
    });
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

//user login

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // employee routes
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/employee/list', [EmployeeController::class, 'index'])->name('employee.list');
            Route::get('/employee/add', [EmployeeController::class, 'add'])->name('employee.add');
            Route::post('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
            Route::post('/employee/delete', [EmployeeController::class, 'delete'])->name('employee.delete');
            Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
            Route::post('/employee/update', [EmployeeController::class, 'update'])->name('employee.update');
            Route::get('/employee/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
        });

        // Task routes
        Route::get('/tasks/list', [TaskController::class, 'index'])->name('admin.task.list');
        Route::get('/tasks/add', [TaskController::class, 'add'])->name('admin.task.add');
        Route::post('/tasks/create', [TaskController::class, 'create'])->name('admin.task.create');
        Route::post('/tasks/delete', [TaskController::class, 'delete'])->name('admin.task.delete');
        Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('admin.task.edit');
        Route::post('/tasks/update', [TaskController::class, 'update'])->name('admin.task.update');


        // Vacancy routes
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('vacancies', [VacancyController::class, 'index'])->name('vacancy.list');
            Route::get('vacancies/create', [VacancyController::class, 'add'])->name('vacancy.create');
            Route::post('vacancies', [VacancyController::class, 'store'])->name('vacancy.store');
            Route::get('vacancies/{id}/edit', [VacancyController::class, 'edit'])->name('vacancy.edit');
            Route::put('vacancies/{id}', [VacancyController::class, 'update'])->name('vacancy.update');
            Route::delete('vacancies/{id}', [VacancyController::class, 'delete'])->name('vacancy.delete');
        });

        // // For Applicants list

        Route::prefix('admin')->group(function () {
            Route::get('/applicants', [ApplicantsController::class, 'index'])->name('admin.applicants.index');
            Route::get('/applicants/create', [ApplicantsController::class, 'create'])->name('admin.applicants.create');
            Route::post('/applicants/store', [ApplicantsController::class, 'store'])->name('admin.applicants.store');
            Route::delete('/applicants/{id}/delete', [ApplicantsController::class, 'destroy'])->name('admin.applicants.destroy');
        });

        // Admin Crud

        Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.admin.list');
        Route::get('/admin/add', [AdminController::class, 'add'])->name('admin.admin.add');
        Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.admin.store');
        Route::post('/admin/delete', [AdminController::class, 'delete'])->name('admin.admin.delete');
        Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
        Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.admin.update');
    });
});

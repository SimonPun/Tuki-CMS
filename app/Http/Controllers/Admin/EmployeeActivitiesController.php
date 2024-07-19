<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Contracts\View\View;

class EmployeeActivitiesController extends Controller
{
    public function show($id): View
    {
        $employee = Employee::with('dailyActivities')->findOrFail($id);
        return view('admin.employees.activities', compact('employee'));
    }
}

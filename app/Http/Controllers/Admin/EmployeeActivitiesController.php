<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Contracts\View\View;

class EmployeeActivitiesController extends Controller
{
    public function show($id): View
    {
        // Fetch the employee with their daily activities and mentioned activities
        $employee = Employee::with([
            'dailyActivities.colleagues', // Load daily activities with associated colleagues
            'mentionedActivities.colleagues' // Load mentioned activities with associated colleagues
        ])->findOrFail($id);

        // Combine dailyActivities and mentionedActivities while removing duplicates
        $allActivities = $employee->dailyActivities->merge($employee->mentionedActivities)->unique('id');

        return view('admin.employees.activities', compact('employee', 'allActivities'));
    }
}

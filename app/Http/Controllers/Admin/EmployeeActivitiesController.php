<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Contracts\View\View;

class EmployeeActivitiesController extends Controller
{
    public function show($id): View
    {
        // Fetch the employee with their daily activities and colleagues, as well as activities they are mentioned in
        $employee = Employee::with([
            'dailyActivities.colleagues', // Load daily activities with associated colleagues
            'activities' => function ($query) { // Load activities the employee is mentioned in
                $query->with('colleagues'); // Load colleagues associated with those activities
            }
        ])->findOrFail($id);

        return view('admin.employees.activities', compact('employee'));
    }
}

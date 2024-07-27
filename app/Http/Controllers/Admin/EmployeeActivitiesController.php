<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Contracts\View\View;

class EmployeeActivitiesController extends Controller
{
    public function show($id): View
    {
        // Fetch employee along with their daily activities and colleagues, as well as mentioned activities
        $employee = Employee::with([
            'dailyActivities.colleagues',
            'mentionedActivities' => function ($query) {
                $query->with('colleagues');
            }
        ])->findOrFail($id);

        return view('admin.employees.activities', compact('employee'));
    }
}

<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        // Fetch the authenticated employee
        $employee = Auth::user();

        // Fetch the activities of the authenticated employee
        $activities = $employee->activities;

        // Pass the activities to the view
        return view('employee.userdashboard', compact('activities'));
    }
}

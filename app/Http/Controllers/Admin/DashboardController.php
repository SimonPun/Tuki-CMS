<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Employee;
use App\Models\DailyActivity; // Import the DailyActivity model

class DashboardController extends Controller
{
    public function index(): View
    {
        // Fetch all employees and daily activities
        $employees = Employee::latest()->get();
        $activities = DailyActivity::latest()->get();

        // Pass both employees and activities to the view
        return view('admin.dashboard', compact('employees', 'activities'));
    }
}

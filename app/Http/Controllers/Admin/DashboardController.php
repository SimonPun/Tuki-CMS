<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index() : View
    {
        $employees = Employee::latest()->get();
      
        return view('admin.dashboard', compact('employees'));
    }
}

<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class EmployeeSettingsController extends Controller
{
    public function edit()
    {
        // Fetch authenticated employee data
        $employee = Auth::guard('employee')->user();

        return view('employee.auth.accountsettings', compact('employee'));
    }

    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . Auth::guard('employee')->id(),
            'password' => 'nullable|string|min:6|confirmed',
            'city' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
        ]);

        // Update employee data
        $employee = Auth::guard('employee')->user();
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        if ($request->has('password')) {
            $employee->password = bcrypt($request->input('password'));
        }
        $employee->city = $request->input('city');
        $employee->linkedin = $request->input('linkedin');
        $employee->facebook = $request->input('facebook');
        $employee->save();

        return redirect()->route('employee.auth.accountsettings')->with('success', 'Account settings updated successfully.');
    }
}

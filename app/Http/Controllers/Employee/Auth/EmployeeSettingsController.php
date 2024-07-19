<?php
// app/Http/Controllers/Employee/Auth/EmployeeSettingsController.php
namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Update employee data
        $employee = Auth::guard('employee')->user();

        if (!$employee) {
            return redirect()->route('employee.auth.accountsettings')->with('error', 'Employee not found.');
        }

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        if ($request->filled('password')) {
            $employee->password = bcrypt($request->input('password'));
        }
        $employee->city = $request->input('city');
        $employee->linkedin = $request->input('linkedin');
        $employee->facebook = $request->input('facebook');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($employee->image) {
                Storage::delete($employee->image);
            }
            // Store new image
            $filename = $request->file('image')->store('employee', 'public');
            $employee->image = $filename;
        }

        try {
            $employee->save();
        } catch (\Exception $e) {
            return redirect()->route('employee.auth.accountsettings')->with('error', $e->getMessage());
        }

        return redirect()->route('employee.auth.accountsettings')->with('success', 'Account settings updated successfully.');
    }
}

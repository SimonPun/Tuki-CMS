<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\EmployeeCredentialsMail;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function add()
    {
        return view('admin.employees.create');
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'position' => 'required|string',
            'password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        $employee = new Employee;

        // Handle image upload
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('employee', 'public');
            $employee->image = $filename;
        } else {
            $employee->image = 'images/dummy-image.jpg'; // Fallback to dummy image
        }

        // Set other employee data
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->position = $request->position;
        $employee->password = Hash::make($request->password); // Hash the password

        // Save the employee
        $employee->save();

        // Send email with credentials
        Mail::to($employee->email)->send(new EmployeeCredentialsMail([
            'name' => $employee->name,
            'email' => $employee->email,
            'password' => $request->password, // Send the plain password
        ]));

        return redirect()->route('admin.employee.list')->with([
            'success' => true,
            'message' => 'Employee created successfully'
        ]);
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.update', compact('employee'));
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id' => 'required|exists:employees,id',
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $request->id,
            'position' => 'required|string',
            'password' => 'nullable|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation as needed
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $employee = Employee::findOrFail($request->id);

            // Handle image update
            if ($request->hasFile('image')) {
                // Delete the old image if it exists and is not the dummy image
                $oldImagePath = public_path('storage/' . $employee->image);
                if (File::exists($oldImagePath) && $employee->image !== 'images/avatar.png') {
                    File::delete($oldImagePath);
                }
                $filename = $request->file('image')->store('employee', 'public');
                $employee->image = $filename;
            }

            // Update other employee data
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->position = $request->position;
            if ($request->filled('password')) {
                $employee->password = Hash::make($request->password); // Hash the password if provided
            }

            // Save the updated employee
            $employee->save();

            return response()->json([
                'success' => true,
                'message' => 'Employee updated successfully'
            ]);
        }
    }

    public function delete(Request $request)
    {
        // Find the employee by ID or fail
        $employee = Employee::findOrFail($request->id);

        // Delete the employee image from storage if it exists and is not the dummy image
        $path = public_path('storage/' . $employee->image);
        if (File::exists($path) && $employee->image !== 'images/dummy-image.jpg') {
            File::delete($path);
        }

        // Delete the employee record
        $employee->delete();

        // Redirect to the index page with a success message
        return redirect()->route('admin.employee.list')->with('success', 'Employee deleted successfully');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.show', compact('employee'));
    }
}

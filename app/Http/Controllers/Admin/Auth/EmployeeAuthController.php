<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends Controller
{
    /**
     * Show the employee login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('employee.auth.employee-login');
    }

    /**
     * Handle an employee login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the employee
        $credentials = $request->only('email', 'password');
        if (Auth::guard('employee')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/employees/userdashboard');
        }

        // Authentication failed, redirect back with error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle an employee logout request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/employee/auth/employee-login');
    }
}

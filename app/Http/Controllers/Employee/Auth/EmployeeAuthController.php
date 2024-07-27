<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class EmployeeAuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('employee.auth.login');
    }

    // Handle the login request
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('employee')->attempt($credentials)) {
            return redirect()->route('employee.dashboard')->with('status', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle the logout request
    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login'); // Redirect to employee login page after logout
    }

    // Show the form for requesting a password reset link
    public function showForgotPasswordForm()
    {
        return view('employee.auth.passwords.email');
    }

    // Handle sending the password reset link
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', __($response))
            : back()->withErrors(
                ['email' => __($response)]
            );
    }

    // Validate the email request
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    // Password broker for employees
    public function broker()
    {
        return Password::broker('employees');
    }

    // Show the form for resetting the password
    public function showResetForm($token)
    {
        return view('employee.auth.passwords.reset')->with('token', $token);
    }

    // Handle updating the password
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::broker('employees')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($employee, $password) {
                $employee->password = Hash::make($password);
                $employee->save();
            }
        );

        return $response === Password::PASSWORD_RESET
            ? redirect()->route('employee.login')->with('status', __($response))
            : back()->withErrors(['email' => [__($response)]]);
    }
}

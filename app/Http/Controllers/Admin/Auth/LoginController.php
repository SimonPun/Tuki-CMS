<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(): View
    {
        return view("admin.auth.login");
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed
            $request->session()->flash('success', 'You have successfully logged in.');
            return redirect()->intended('/admin/dashboard'); // Change this to your intended redirect path
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->flash('success', 'You have successfully logged out.');
        return redirect()->route('admin.auth.login');
    }
}

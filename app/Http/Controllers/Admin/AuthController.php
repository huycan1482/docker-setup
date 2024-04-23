<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller 
{
    public function getLogin (): View
    {
        // :View return về view
        return view('admin.auth.login');
    }

    public function postLogin (LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
 
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('admin.getLogin');
    }

    public function getRegister (): View
    {
        return view('admin.auth.register');
    }
}
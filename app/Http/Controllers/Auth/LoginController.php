<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show() {
        return view('auth.login');
    }

    public function login(Request $request) {
        if (Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        return back();
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}

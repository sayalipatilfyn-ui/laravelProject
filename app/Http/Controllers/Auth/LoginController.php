<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


// public function login(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required|string',
//     ]);

//     if (Auth::attempt($request->only('email', 'password'))) {
//         $request->session()->regenerate();

//         $user = Auth::user(); // ✅ THIS IS THE FIX

//         return response()->json([
//             'success' => true,
//             'message' => 'Login successful',
//             'user' => [
//                 'id' => $user->id,
//                 'name' => $user->name,
//                 'email' => $user->email,
//             ],
//         ], 200);
//     }

//     return response()->json([
//         'success' => false,
//         'message' => 'Invalid credentials',
//     ], 401);
// }

}

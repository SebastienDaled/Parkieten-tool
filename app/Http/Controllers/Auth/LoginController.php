<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ring;
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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $rings = Ring::getAllRings();

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Authenticatie geslaagd
            return redirect()->intended('/home');
        }

        // Authenticatie mislukt
        return back()->withErrors([
            'email' => 'De ingevoerde gegevens zijn ongeldig.',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}

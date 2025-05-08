<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function  index()
    {
            return view('login.index');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
            //     'string',
            //     'min:8', // Minimal 8 karakter
            //     'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/' // Harus mengandung huruf dan angka
            // ],
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if (!$user->is_active) {
            return redirect('/verify-otp')->with('warning', 'Akun Anda belum diverifikasi. Silakan masukkan kode OTP.');
        }
        elseif(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        else{
            return back()->withErrors('loginError', 'Login gagal!');
        }
    }
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}

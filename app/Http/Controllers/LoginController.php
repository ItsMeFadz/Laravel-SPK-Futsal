<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('admin.layouts.auth.index',[
            'title' => 'Login',
            'active' => 'Login'
        ]);
    }

    public function login_proses(Request $request)
    {
        Log::info('Data yang diterima:', $request->all());

        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'exists:users,username'],
            'password' => ['required'],
        ], [
            'username.exists' => 'username tidak terdaftar.',
            'password.required' => 'Password harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Ambil data user yang login

            $request->session()->regenerate();
            Log::info('Login berhasil untuk: ' . $user->username);
            return redirect()->route('Dashboard');
        }

        Log::error('Gagal login: Password salah');
        return redirect()->back()->with('loginError', 'Gagal Masuk, password salah')->withInput();
    }

    public function logout(Request $request)
    {
        Log::info('Logout method called');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth');
    }
}

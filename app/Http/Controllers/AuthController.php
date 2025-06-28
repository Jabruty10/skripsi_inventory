<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin(Request $request)
    {
        // Redirect ke beranda jika sudah login
        if ($request->session()->has('user')) {
            return redirect('/');
        }
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required|min:5',
        ], [
            'username.required' => 'Email wajib diisi.',
            'username.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 karakter.'
        ]);

        $user = DB::table('login')->where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan session login
            $request->session()->put('user', [
                'id_user' => $user->id_user,
                'username' => $user->username
            ]);
            return redirect('/')->with('success', 'Berhasil login.');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/login')->with('success', 'Berhasil logout.');
    }

    // Menampilkan halaman register
    public function showRegister(Request $request)
    {
        // Redirect jika sudah login
        if ($request->session()->has('user')) {
            return redirect('/');
        }
        return view('register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|email|unique:login,username',
            'password' => 'required|min:5',
        ], [
            'username.required' => 'Email wajib diisi.',
            'username.email' => 'Format email tidak valid.',
            'username.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 karakter.',
        ]);

        DB::table('login')->insert([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login')->with('success', 'Berhasil daftar. Silakan login.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
{
    return view('login');
}

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required|email',
        'password' => 'required',
    ]);

    $user = \DB::table('login')->where('username', $request->username)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        $request->session()->put('user', [
            'id_user' => $user->id_user,
            'username' => $user->username
        ]);
        return redirect('/');
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
}

    public function logout(Request $request)
{
    $request->session()->forget('user');
    return redirect('/login');
}

    public function showRegister()
{
    return view('register');
}

    public function register(Request $request)
{
    $request->validate([
        'username' => 'required|email|unique:login,username',
        'password' => 'required|min:5',
    ]);

    \DB::table('login')->insert([
        'username' => $request->username,
        'password' => bcrypt($request->password), // hash password
    ]);

    return redirect('/login')->with('success', 'Berhasil daftar, silakan login.');
}

}

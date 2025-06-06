<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('Admin.login');
    }


    public function process(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'max:50'],
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {

            if (Auth::user()->role_id == 1) {
                return redirect('admin/dashboard');
            }
            if (Auth::user()->role_id == 2) {
                return redirect('pengguna/pendaftaran');
            }
        }

        Session::flash('status', 'Username atau Password Salah');
        Session::flash('message', 'Username atau password tidak sesuai, atau akun Anda masih belum aktif.');
        return redirect('/login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // default pengguna biasa
        ]);

        return redirect('/register')->with('status', 'Akun berhasil dibuat. Silakan login.');
    }
}

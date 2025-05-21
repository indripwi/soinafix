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
                return redirect('anggota/profile');
            }
        }

        Session::flash('status', 'Username atau Password Salah');
        Session::flash('message', 'Username atau password tidak sesuai, atau akun Anda masih belum aktif.');
        return redirect('/login');
    }
}

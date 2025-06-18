<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role_id == 1) {
                return redirect()->intended('admin/dashboard');
            }

            if ($user->role_id == 2) {
                return redirect()->intended('pengguna/pendaftaran');
            }
        }

        Session::flash('status', 'Username atau Password Salah');
        Session::flash('message', 'Username atau password tidak sesuai, atau akun Anda masih belum aktif.');
        return redirect('/login');
    }

    public function register()
    {
        return view('Admin.register');
    }

    public function Registerprocess(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:50'],
        'email' => ['required', 'email', 'max:100', 'unique:users'],
        'password' => ['required', 'string', 'min:6'],
    ]);

    try {
        Log::info('Register user', $request->all());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        Log::info('User registered successfully');

        return redirect('/register')->with('status', 'Akun berhasil dibuat. Silakan login.');
    } catch (\Exception $e) {
        Log::error('Error saat register: ' . $e->getMessage());
        return back()->with('message', 'Terjadi kesalahan saat mendaftar.')->withInput();
    }
}


    public function forgotPasswordForm()
    {
        return view('Admin.forgot-password'); // Buat file Blade ini
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $token = Str::random(64);

        DB::table('password_resets_pendaftaran')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // Kirim email ke user
        $user->notify(new ResetPasswordNotification($token));

        return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
    }

    public function verifyForm()
    {
        return view('Admin.verify-code'); // Buat file Blade ini
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required'
        ]);

        $record = DB::table('password_resets_pendaftaran')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record || now()->diffInMinutes($record->created_at) > 15) {
            return back()->withErrors(['token' => 'Kode tidak valid atau kadaluarsa.']);
        }

        // Token valid, tampilkan form reset password
        return view('Admin.reset-password', ['email' => $request->email]);
    }

    public function resetPasswordForm($token)
    {
        return view('Admin.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required'
        ]);

        $record = DB::table('password_resets_pendaftaran')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record || Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['email' => 'Token tidak valid atau sudah kedaluwarsa.']);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_resets_pendaftaran')->where('email', $request->email)->delete();

        return redirect('/login')->with('status', 'Password berhasil direset. Silakan login.');
    }

    public function profile()
    {
        $loginUser = auth()->user();
        $biodata = $loginUser->biodata; // <-- Pastikan ini ada

        return view('Admin.profile', compact('loginUser', 'biodata'));
    }




    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'nama_user' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $biodata = \App\Models\UserBiodata::findOrFail($id);

        $biodata->nama_user = $request->nama_user;
        $biodata->email = $request->email;
        $biodata->telepon = $request->telepon;
        $biodata->alamat = $request->alamat;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto', 'public');
            $biodata->foto = $path;
        }

        $biodata->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}

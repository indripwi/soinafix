<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserBiodata;

class UserBiodataController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        $user->profile->update([
            'telepon' => $request->telepon,
            'nik'     => $request->nik,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateFoto(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('public/foto', $filename);

            $user->profile->update(['foto' => $filename]);
        }

        return redirect()->route('profile.show')->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'password' => 'required|string|min:6|confirmed', // kalau kamu pakai konfirmasi
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Password berhasil diperbarui.');
    }
}

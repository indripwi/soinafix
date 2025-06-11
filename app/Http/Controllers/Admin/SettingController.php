<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $status = Setting::getValue('pendaftaran_status', 'tutup'); // default 'tutup'
        return view('admin.setting', compact('status'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required|in:buka,tutup'
        ]);

        Setting::setValue('pendaftaran_status', $request->status);

        return redirect()->back()->with('success', 'Status pendaftaran diperbarui.');
    }
}


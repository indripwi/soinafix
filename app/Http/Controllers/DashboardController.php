<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $jumlahPendaftar = Pendaftaran::count();
        return view('admin.dashboard', compact('jumlahPendaftar'));
    }
    
}

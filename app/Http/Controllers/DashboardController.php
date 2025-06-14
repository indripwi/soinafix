<?php

namespace App\Http\Controllers;

use App\Models\Coache;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Program;
use App\Models\Pengurus;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $jumlahPendaftar = Pendaftaran::count();
        $jumlahProgram = Program::count();
        $jumlahPengurus = Coache::count();

        return view('admin.dashboard', compact(
            'jumlahPendaftar',
            'jumlahProgram',
            'jumlahPengurus'
        ));
    }
}
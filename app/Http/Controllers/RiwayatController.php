<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function riwayat()
    {
        $pendaftar = DB::table('tb_pendaftaran')->get(); // atau: Model::all()
        return view('Pengguna.riwayat', compact('pendaftar'));
    }
}

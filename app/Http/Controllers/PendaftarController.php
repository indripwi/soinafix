<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftarController extends Controller
{
    public function index()
    {
       $pendaftar = DB::table('tb_pendaftaran')->get(); // atau: Model::all()
        return view('Admin.adm_pendaftar', compact('pendaftar'));
    }
}

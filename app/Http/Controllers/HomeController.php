<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Program;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage()
    {
        return view('Pengguna.homepage');
    }
    public function pengumuman()
    {
        return view('Pengguna.pengumuman');
    }
    public function pengurus()
    {
        return view('Pengguna.pengurus');
    }
    public function prestasi()
    {
        $prestasi = Prestasi::all();
        return view('Pengguna.prestasi', compact('prestasi'));
    }
    public function program()
    {
        $program = Program::all();
        return view('Pengguna.program', compact('program'));
    }
    public function pendaftaran()
    {
        return view('Pengguna.pendaftaran');
    }
    public function tentang()
    {
        return view('Pengguna.tentang');
    }
}

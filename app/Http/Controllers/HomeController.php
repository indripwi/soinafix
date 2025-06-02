<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Coache;
use App\Models\Pendaftaran;
use App\Models\Prestasi;
use App\Models\Program;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage()
{
    $programs = Program::latest()->take(4)->get();
    $coaches = Coache::latest()->take(3)->get();
    return view('Pengguna.homepage', compact('programs', 'coaches'));
}
    public function pengumuman()
    {
        $announcement = Announcement::all();
        return view('Pengguna.pengumuman', compact('announcement'));
    }
    public function pengurus()
    {
        $coache = Coache::all();
        return view('Pengguna.pengurus', compact('coache'));
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
        $pendaftarans = Pendaftaran::all();
        return view('Pengguna.pendaftaran', compact('pendaftarans'));
    }
    public function tentang()
    {
        return view('Pengguna.tentang');
    }
}

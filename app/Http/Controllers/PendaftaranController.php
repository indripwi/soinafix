<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'sekolah' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'akta_kelahiran' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'raport_terakhir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'tes_psikologi' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Simpan file upload ke storage
        $akta = $request->file('akta_kelahiran')->store('uploads/akta');
        $kk = $request->file('kartu_keluarga')->store('uploads/kk');
        $foto = $request->file('pas_foto')->store('uploads/foto');
        $raport = $request->file('raport_terakhir')->store('uploads/raport');
        $psikologi = $request->file('tes_psikologi')->store('uploads/psikologi');
        
        // Simpan semua ke database (ke tabel tb_pendaftaran)
        DB::table('tb_pendaftaran')->insert([
            'nama_pendaftar' => $request->nama,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin === 'Laki-laki' ? 'L' : 'P',
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'sekolah' => $request->sekolah,
            'kelas' => $request->kelas,
            'file_akta' => $akta,
            'file_kk' => $kk,
            'file_foto' => $foto,
            'file_raport' => $raport,
            'file_psikolog' => $psikologi,
            'tanggal_daftar' => now(),
            'status_verifikasi' => 'N'
        ]);

        return redirect()->route('riwayat')->with('success', 'Pendaftaran berhasil disimpan!');
    }
}

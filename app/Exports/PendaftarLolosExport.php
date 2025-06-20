<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftarLolosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pendaftaran::where('status_verifikasi', 'lolos')
            ->select('nama_pendaftar', 'nik', 'nomor_telepon', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'sekolah', 'kelas')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIK',
            'Telepon',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Sekolah',
            'Kelas',
        ];
    }
}


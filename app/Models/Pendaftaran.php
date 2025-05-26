<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'nama_pendaftar',
        'nik',
        'nomor_telepon',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'sekolah',
        'kelas',
        'file_akta',
        'file_kk',
        'file_foto',
        'file_raport',
        'file_psikolog',
        'tanggal_daftar',
        'status_verifikasi',
        'periode',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'datetime',
    ];
}

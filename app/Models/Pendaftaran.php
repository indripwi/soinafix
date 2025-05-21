<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    use Sluggable;

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
        'created_at',
    ];

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'user_id'
            ]
        ];
    }

}

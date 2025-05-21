<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestasi extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'nama_atlet',
        'slug',
        'cabang_olahraga',
        'deskripsi',
        'foto_url',
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
                'source' => 'nama_atlet'
            ]
        ];
    }
}

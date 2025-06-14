<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBiodata extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'user_id',
        'slug',
        'nama_user',
        'email',
        'telepon',
        'alamat',
        'foto',
    ];

    public function profile()
{
    return $this->hasOne(UserBiodata::class);
}

 /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_user'
            ]
        ];
    }

    // app/Models/User.php
public function user()
    {
        return $this->belongsTo(User::class);
    }

public function biodata()
{
    return $this->hasOne(UserBiodata::class);
}

}

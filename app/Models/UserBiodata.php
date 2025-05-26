<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBiodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_user',
        'email',
        'telepon',
        'alamat',
        'foto',
    ];
// app/Models/User.php
public function profile()
{
    return $this->hasOne(\App\Models\UserBiodata::class);
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()

}

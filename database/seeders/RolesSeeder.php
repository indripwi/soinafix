<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua data sebelum seeding ulang
        DB::table('roles')->delete();


        // Isi ulang
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Pengguna'],
        ]);
    }
}

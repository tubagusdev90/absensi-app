<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use App\Models\Position;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        
        Karyawan::create([
            'nama_karyawan' => "Tubagus Mochamad Isnaeni",
            'email'         => "tubagus@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 3,
        ]);
        
        Karyawan::create([
            'nama_karyawan' => "Median Prasetya",
            'email'         => "median@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 2,
        ]);

        Karyawan::create([
            'nama_karyawan' => "Luthfy Aqil Muchtar",
            'email'         => "luthfy@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 2,
        ]);

        Karyawan::create([
            'nama_karyawan' => "Raka Prasetya Nugraha",
            'email'         => "raka@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 2,
        ]);

        Karyawan::create([
            'nama_karyawan' => "Eko Purnomo Aji",
            'email'         => "ekopass@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 2,
        ]);

        Karyawan::create([
            'nama_karyawan' => "Raden Bambang Ergiansyah",
            'email'         => "rbe@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 6,
        ]);

        Karyawan::create([
            'nama_karyawan' => "Dennie Prasetyo",
            'email'         => "dennie@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 4,
        ]);

        Karyawan::create([
            'nama_karyawan' => "Park Jin Su",
            'email'         => "pjs@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 5,
        ]);

        Karyawan::create([
            'nama_karyawan' => "Kim Dong Soo",
            'email'         => "kds@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 7,
        ]);

        Karyawan::create([
            'nama_karyawan' => "Baek Seung Cheul",
            'email'         => "bsc@posco.net",
            'team_id'       => 3,              // Ubah jika pakai banyak team
            'position_id'   => 8,
        ]);
        
    }
}

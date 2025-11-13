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
        // Ambil semua posisi
        $positions = Position::all();

        if ($positions->count() == 0) {
            $this->command->error("Positions table is empty, run PositionSeeder first.");
            return;
        }

        // Contoh team_id untuk semua karyawan (ubah sesuai kebutuhan)
        $teamId = 1;

        // Buat 20 karyawan
        for ($i = 1; $i <= 20; $i++) {

            // ambil posisi secara acak
            $position = $positions->random();

            Karyawan::create([
                'nama_karyawan' => "Karyawan {$i}",
                'email'         => "karyawan{$i}@example.com",
                'team_id'       => $teamId,              // Ubah jika pakai banyak team
                'position_id'   => $position->id,
            ]);
        }
    }
}

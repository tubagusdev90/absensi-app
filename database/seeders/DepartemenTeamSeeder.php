<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Team;
use Illuminate\Database\Seeder;

class DepartemenTeamSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'MSD' => ['HR Team', 'GA Team'],
            'ITB' => ['P/C Team', 'Infra Team', 'MES Team'],
            'FCD' => ['CCP Team', 'SMP Team', 'Coke Team', 'RMH Team', 'Sinter Team', 'Gas Team', 'Plate Mill Team', 'HRP Team'],
            'CMD' => ['Crane Team', 'Instrument Team', 'Field Repair Team'],
        ];

        foreach ($data as $depName => $teams) {
            $dep = Departemen::firstOrCreate(['nama_departemen' => $depName]);
            foreach ($teams as $t) {
                Team::firstOrCreate([
                    'departemen_id' => $dep->id,
                    'nama_team' => $t,
                ]);
            }
        }
    }
}


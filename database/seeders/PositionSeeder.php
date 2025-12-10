<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            ['key' => 'super_admin',        'position_name' => 'Super Admin'],
            ['key' => 'team_member',        'position_name' => 'Team Member'],
            ['key' => 'group_leader',       'position_name' => 'Group Leader'],
            ['key' => 'section_leader',     'position_name' => 'Section Leader'],
            ['key' => 'supervisor',         'position_name' => 'Supervisor'],
            ['key' => 'assistant_manager',  'position_name' => 'Assistant Manager'],
            ['key' => 'team_manager',       'position_name' => 'Team Manager'],
            ['key' => 'departement_manager','position_name' => 'Departement Manager'],
        ];

        foreach ($positions as $pos) {
            Position::updateOrCreate(['key' => $pos['key']], $pos);
        }
    }
}

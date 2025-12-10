<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminPositionId = Position::where('key', 'super_admin')->value('id');
        // Membuat akun pertama
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'position_id' => '1',
            'password' => Hash::make('super'),
            'email_verified_at' => now(),
        ]);
    }
}


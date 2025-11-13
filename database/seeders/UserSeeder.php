<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // Hapus user lama agar tidak duplikat (opsional, hanya untuk testing/dev)
        User::where('email', 'tubagusdev@gmail.com')->delete();

        // Buat user default / admin
        User::create([
            'name' => 'Tubagus Mochamad Isnaeni',
            'email' => 'tubagusdev@gmail.com',
            'password' => Hash::make('admin'), // Gunakan Hash agar sesuai dengan login
        ]);

        // (Opsional) Tambahkan beberapa dummy user lainnya
        User::factory()->count(5)->create();
    }
}

<?php

namespace Tests\Feature\Integration;

use App\Models\User;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginIntegrationTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function login_with_valid_user_is_successful()
    {
        // Simpan HASH ke DB
        $user = User::factory()->create([
            'email' => 'tubagus@gmail.com',
            'password' => Hash::make('admin1'),
        ]);

        // Kirim PLAIN TEXT ke attempt()
        $ok = Auth::attempt([
            'email' => 'tubagus@gmail.com',
            'password' => 'admin1',   // ← plain!
        ]);

        $this->assertTrue($ok);
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function login_fails_with_invalid_password()
    {
        User::factory()->create([
            'email' => 'tubagus1@gmail.com',
            'password' => Hash::make('admin2'),
        ]);

        // Password salah, tetap PLAIN TEXT
        $ok = Auth::attempt([
            'email' => 'tubagus1@gmail.com',
            'password' => '12admin', // ← plain!
        ]);

        $this->assertFalse($ok);
        $this->assertGuest();
    }
}

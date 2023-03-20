<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Throwable;

class UserTest extends TestCase
{
use RefreshDatabase;
    /** @test */
    public function user_has_expected_table()
    {
        $this->assertTrue(
            Schema::hasTable('users')
        );
    }

    /** @test */
    public function user_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('users', ['id', 'name', 'email', 'image', 'email_verified_at', 'role', 'password'])
        );
    }

    /** @test */
    public function user_can_be_created()
    {
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@dev.com',
            'role' => 'scout',
            'password' => Hash::make('123456789'),
        ]);

        $this->assertModelExists($user);
    }

    /** @test */
    public function user_can_be_deleted()
    {
        $user = User::create([
            'name' => 'Prueba2',
            'email' => 'prueba2@dev.com',
            'role' => 'player',
            'password' => Hash::make('123456789'),
        ]);

        $user->delete();
        $this->assertModelMissing($user);
    }
}

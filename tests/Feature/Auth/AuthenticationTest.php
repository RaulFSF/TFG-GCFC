<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@dev.com',
            'role' => 'scout',
            'password' => Hash::make('123456789'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@dev.com',
            'role' => 'scout',
            'password' => Hash::make('123456789'),
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}

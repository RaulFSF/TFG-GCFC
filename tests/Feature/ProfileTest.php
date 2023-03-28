<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@dev.com',
            'role' => 'scout',
            'password' => Hash::make('123456789'),
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@dev.com',
            'role' => 'scout',
            'password' => Hash::make('123456789'),
        ]);

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => '123456789',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@dev.com',
            'role' => 'scout',
            'password' => Hash::make('123456789'),
        ]);

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}

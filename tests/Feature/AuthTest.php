<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase; // Vide la base entre chaque test

    #[Test]
    public function a_user_can_register()
    {
        $response = $this->post('/register', [
            'first_name' => 'Alice',
            'last_name' => 'Dupont',
            'pseudo' => 'alicouette',
            'email' => 'alice@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/dashboard'); // ou vers la page après inscription
        $this->assertDatabaseHas('users', ['email' => 'alice@example.com']);
        $this->assertAuthenticated();
    }

    #[Test]
    public function a_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'bob@example.com',
            'password' => bcrypt('secret123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'bob@example.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/dashboard'); // ou ta route post-login
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function login_fails_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('validpass'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpass',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest(); // personne n’est connecté
    }
}

<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AuthTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);
    
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
    
        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    #[Test]
    public function users_cannot_authenticate_with_invalid_password()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('validpass'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpass',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    #[Test]
    public function users_cannot_authenticate_with_nonexistent_account()
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    #[Test]
    public function users_can_logout()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('validpass'),
        ]);

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_password_can_be_updated(): void
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class); // ← ici

    $user = User::factory()->create([
        'password' => bcrypt('old-password'),
    ]);

    $response = $this
        ->actingAs($user)
        ->put('/password', [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response->assertSessionHasNoErrors();
}

protected function setUp(): void
{
    parent::setUp();
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
}
}
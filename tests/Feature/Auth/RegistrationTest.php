<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registration_form_can_be_displayed()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertSee('Register');
    }

    /** @test */
    public function user_can_register_with_valid_data()
    {
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('home')); // Adapte selon ta route d’après inscription

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);

        $user = User::where('email', 'john@example.com')->first();

        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('password123', $user->password));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function registration_fails_with_invalid_email()
    {
        $response = $this->from(route('register'))->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'not-an-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    public function registration_fails_when_passwords_do_not_match()
    {
        $response = $this->from(route('register'))->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password456',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    /** @test */
    public function registration_fails_when_email_already_taken()
    {
        User::factory()->create(['email' => 'john@example.com']);

        $response = $this->from(route('register'))->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}

<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\User;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_password_reset_request_form()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200);
        $response->assertSee('Reset Password');
    }

    /** @test */
    public function user_can_request_password_reset_link()
    {
        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status', trans(Password::RESET_LINK_SENT));

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /** @test */
    public function user_can_view_password_reset_form_with_token()
    {
        $user = User::factory()->create();

        $token = Password::createToken($user);

        $response = $this->get(route('password.reset', ['token' => $token]));

        $response->assertStatus(200);
        $response->assertSee('Reset Password');
        $response->assertSee($token);
    }

    /** @test */
    public function user_can_reset_password_with_valid_token()
    {
        $user = User::factory()->create();

        $token = Password::createToken($user);

        $newPassword = 'new-password';

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response->assertRedirect(route('login'));
        $this->assertTrue(auth()->attempt([
            'email' => $user->email,
            'password' => $newPassword,
        ]));
    }

    /** @test */
    public function reset_password_fails_with_invalid_token()
    {
        $user = User::factory()->create();

        $response = $this->from(route('password.reset', ['token' => 'invalid-token']))
                         ->post(route('password.update'), [
                            'token' => 'invalid-token',
                            'email' => $user->email,
                            'password' => 'new-password',
                            'password_confirmation' => 'new-password',
                         ]);

        $response->assertRedirect(route('password.reset', ['token' => 'invalid-token']));
        $response->assertSessionHasErrors('email');
    }
}

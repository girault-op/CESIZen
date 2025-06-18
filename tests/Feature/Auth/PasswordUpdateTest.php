<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_view_password_update_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('password.edit'));

        $response->assertStatus(200);
        $response->assertSee('Update Password');
    }

    /** @test */
    public function authenticated_user_can_update_password_with_valid_data()
    {
        $user = User::factory()->create([
            'password' => bcrypt('old-password'),
        ]);

        $newPassword = 'new-secure-password';

        $response = $this->actingAs($user)->post(route('password.update'), [
            'current_password' => 'old-password',
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response->assertRedirect(route('profile')); // Modifier selon ta route après update

        $user->refresh();

        $this->assertTrue(Hash::check($newPassword, $user->password));
    }

    /** @test */
    public function update_fails_if_current_password_is_incorrect()
    {
        $user = User::factory()->create([
            'password' => bcrypt('correct-password'),
        ]);

        $response = $this->actingAs($user)->from(route('password.edit'))->post(route('password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertRedirect(route('password.edit'));
        $response->assertSessionHasErrors('current_password');
    }

    /** @test */
    public function update_fails_if_password_confirmation_does_not_match()
    {
        $user = User::factory()->create([
            'password' => bcrypt('old-password'),
        ]);

        $response = $this->actingAs($user)->from(route('password.edit'))->post(route('password.update'), [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'different-password',
        ]);

        $response->assertRedirect(route('password.edit'));
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function guest_cannot_access_password_update_routes()
    {
        $response = $this->get(route('password.edit'));
        $response->assertRedirect(route('login'));

        $response = $this->post(route('password.update'), []);
        $response->assertRedirect(route('login'));
    }
}

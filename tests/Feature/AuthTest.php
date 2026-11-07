<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        foreach (['/', '/console', '/videogiochi', '/recensioni'] as $uri) {
            $this->get($uri)->assertRedirect('/login');
        }
    }

    public function test_a_user_can_register_and_is_sent_to_login(): void
    {
        $this->post('/registrazione', [
            'nome' => 'Mario',
            'cognome' => 'Rossi',
            'email' => 'mario@example.com',
            'password' => 'segreta1',
        ])->assertRedirect('/login');

        $this->assertDatabaseHas('users', ['email' => 'mario@example.com', 'cognome' => 'Rossi']);
        $this->assertGuest();
    }

    public function test_registration_rejects_a_duplicate_email(): void
    {
        User::factory()->create(['email' => 'mario@example.com']);

        $this->from('/registrazione')->post('/registrazione', [
            'nome' => 'Mario',
            'cognome' => 'Rossi',
            'email' => 'mario@example.com',
            'password' => 'segreta1',
        ])->assertRedirect('/registrazione')->assertSessionHasErrors('email');
    }

    public function test_registration_rejects_a_short_password(): void
    {
        $this->post('/registrazione', [
            'nome' => 'Mario',
            'cognome' => 'Rossi',
            'email' => 'mario@example.com',
            'password' => '12345',
        ])->assertSessionHasErrors('password');
    }

    public function test_a_user_can_log_in_and_out(): void
    {
        $user = User::factory()->create(['password' => 'segreta1']);

        $this->post('/login', ['email' => $user->email, 'password' => 'segreta1'])->assertRedirect('/');
        $this->assertAuthenticatedAs($user);

        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_a_wrong_password_is_rejected(): void
    {
        $user = User::factory()->create(['password' => 'segreta1']);

        $this->post('/login', ['email' => $user->email, 'password' => 'sbagliata'])->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}

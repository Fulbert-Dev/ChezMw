<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can authenticate with spaces and uppercase letters around their email', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
    ]);

    $this->post('/login', [
        'email' => '  USER@EXAMPLE.COM  ',
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($user);
});

test('legacy accounts with an unhashed password are upgraded at login', function () {
    $user = User::factory()->create([
        'email' => 'legacy@example.com',
    ]);

    DB::table('users')->where('id', $user->id)->update([
        'password' => 'legacy-password',
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'legacy-password',
    ]);

    $this->assertAuthenticatedAs($user);
    expect(Hash::check('legacy-password', DB::table('users')->where('id', $user->id)->value('password')))->toBeTrue();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

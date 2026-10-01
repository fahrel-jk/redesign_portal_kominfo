<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('admin login page is accessible', function () {
    $response = $this->get(route('admin.login'));
    $response->assertStatus(200);
    $response->assertSee('CMS Portal Layanan');
});

test('admin can authenticate with correct credentials', function () {
    $user = User::create([
        'name' => 'Admin Test',
        'email' => 'admin@kominfo.test',
        'password' => Hash::make('password123'),
        'role' => 'admin',
    ]);

    $response = $this->post(route('admin.login.submit'), [
        'email' => 'admin@kominfo.test',
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticatedAs($user);
});

test('admin login fails with invalid credentials', function () {
    User::create([
        'name' => 'Admin Test',
        'email' => 'admin@kominfo.test',
        'password' => Hash::make('password123'),
        'role' => 'admin',
    ]);

    $response = $this->post(route('admin.login.submit'), [
        'email' => 'admin@kominfo.test',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('unauthenticated users cannot access dashboard', function () {
    $response = $this->get(route('admin.dashboard'));
    $response->assertRedirect(route('admin.login'));
});

test('authenticated admin can logout', function () {
    $user = User::create([
        'name' => 'Admin Test',
        'email' => 'admin@kominfo.test',
        'password' => Hash::make('password123'),
        'role' => 'admin',
    ]);

    $this->actingAs($user);

    $response = $this->post(route('admin.logout'));
    $response->assertRedirect(route('admin.login'));
    $this->assertGuest();
});

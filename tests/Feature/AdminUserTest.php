<?php

use App\Models\User;

beforeEach(function () {
    $this->admin = User::create([
        'name' => 'Main Admin',
        'email' => 'mainadmin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);
});

test('admin can view users list', function () {
    $response = $this->actingAs($this->admin)->get(route('admin.users.index'));
    $response->assertStatus(200);
    $response->assertSee('Main Admin');
});

test('admin can create new user', function () {
    $response = $this->actingAs($this->admin)->post(route('admin.users.store'), [
        'name' => 'New Admin',
        'email' => 'newadmin@example.com',
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
        'role' => 'admin',
    ]);

    $response->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseHas('users', [
        'name' => 'New Admin',
        'email' => 'newadmin@example.com',
    ]);
});

test('admin can update user', function () {
    $user = User::create([
        'name' => 'Staff User',
        'email' => 'staff@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    $response = $this->actingAs($this->admin)->put(route('admin.users.update', $user), [
        'name' => 'Staff User Updated',
        'email' => 'staff@example.com',
        'role' => 'admin',
    ]);

    $response->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Staff User Updated',
    ]);
});

test('admin cannot delete the last remaining user', function () {
    $response = $this->actingAs($this->admin)->delete(route('admin.users.destroy', $this->admin));
    $response->assertRedirect();
    $response->assertSessionHas('error');

    $this->assertDatabaseHas('users', [
        'id' => $this->admin->id,
    ]);
});

test('admin can delete user if multiple exist', function () {
    $otherUser = User::create([
        'name' => 'Other User',
        'email' => 'other@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    $response = $this->actingAs($this->admin)->delete(route('admin.users.destroy', $otherUser));
    $response->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseMissing('users', [
        'id' => $otherUser->id,
    ]);
});

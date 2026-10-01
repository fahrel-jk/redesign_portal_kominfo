<?php

use App\Models\Gallery;
use App\Models\User;

beforeEach(function () {
    $this->user = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);
});

test('admin can view galleries list', function () {
    Gallery::create([
        'title' => 'Foto Pertama',
        'tag' => 'Kegiatan',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)->get(route('admin.galleries.index'));
    $response->assertStatus(200);
    $response->assertSee('Foto Pertama');
});

test('admin can create gallery', function () {
    $response = $this->actingAs($this->user)->post(route('admin.galleries.store'), [
        'title' => 'Foto Baru',
        'tag' => 'Event',
        'description' => 'Deskripsi foto baru.',
        'sort_order' => 1,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.galleries.index'));
    $this->assertDatabaseHas('galleries', [
        'title' => 'Foto Baru',
        'tag' => 'Event',
    ]);
});

test('admin can edit and update gallery', function () {
    $gallery = Gallery::create([
        'title' => 'Foto Lama',
        'tag' => 'Kegiatan',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)->put(route('admin.galleries.update', $gallery), [
        'title' => 'Foto Diperbarui',
        'tag' => 'Seminar',
        'description' => 'Deskripsi baru.',
        'sort_order' => 2,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.galleries.index'));
    $this->assertDatabaseHas('galleries', [
        'id' => $gallery->id,
        'title' => 'Foto Diperbarui',
        'sort_order' => 2,
    ]);
});

test('admin can toggle gallery active status', function () {
    $gallery = Gallery::create([
        'title' => 'Foto Toggle',
        'tag' => 'Kegiatan',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)->patch(route('admin.galleries.toggle', $gallery));
    $response->assertRedirect();

    expect($gallery->fresh()->is_active)->toBeFalse();
});

test('admin can delete gallery', function () {
    $gallery = Gallery::create([
        'title' => 'Foto Hapus',
        'tag' => 'Kegiatan',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)->delete(route('admin.galleries.destroy', $gallery));
    $response->assertRedirect(route('admin.galleries.index'));

    $this->assertDatabaseMissing('galleries', [
        'id' => $gallery->id,
    ]);
});

<?php

use App\Models\News;
use App\Models\User;

beforeEach(function () {
    $this->user = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);
});

test('admin can view news list', function () {
    News::create([
        'title' => 'Berita Pertama',
        'slug' => 'berita-pertama',
        'category' => 'Pemerintahan',
        'summary' => 'Ringkasan berita pertama.',
        'is_active' => true,
        'published_at' => now(),
    ]);

    $response = $this->actingAs($this->user)->get(route('admin.news.index'));
    $response->assertStatus(200);
    $response->assertSee('Berita Pertama');
});

test('admin can create news', function () {
    $response = $this->actingAs($this->user)->post(route('admin.news.store'), [
        'title' => 'Berita Baru',
        'category' => 'Digitalisasi',
        'summary' => 'Ringkasan berita baru.',
        'content' => 'Isi konten berita baru.',
        'published_at' => '2026-09-28',
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.news.index'));
    $this->assertDatabaseHas('news', [
        'title' => 'Berita Baru',
        'category' => 'Digitalisasi',
    ]);
});

test('admin can edit and update news', function () {
    $news = News::create([
        'title' => 'Berita Lama',
        'slug' => 'berita-lama',
        'category' => 'Pemerintahan',
        'is_active' => true,
        'published_at' => now(),
    ]);

    $response = $this->actingAs($this->user)->put(route('admin.news.update', $news), [
        'title' => 'Berita Diperbarui',
        'category' => 'Pengumuman',
        'summary' => 'Ringkasan baru.',
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.news.index'));
    $this->assertDatabaseHas('news', [
        'id' => $news->id,
        'title' => 'Berita Diperbarui',
        'category' => 'Pengumuman',
    ]);
});

test('admin can toggle news active status', function () {
    $news = News::create([
        'title' => 'Berita Toggle',
        'slug' => 'berita-toggle',
        'category' => 'Pemerintahan',
        'is_active' => true,
        'published_at' => now(),
    ]);

    $response = $this->actingAs($this->user)->patch(route('admin.news.toggle', $news));
    $response->assertRedirect();

    expect($news->fresh()->is_active)->toBeFalse();
});

test('admin can delete news', function () {
    $news = News::create([
        'title' => 'Berita Hapus',
        'slug' => 'berita-hapus',
        'category' => 'Pemerintahan',
        'is_active' => true,
        'published_at' => now(),
    ]);

    $response = $this->actingAs($this->user)->delete(route('admin.news.destroy', $news));
    $response->assertRedirect(route('admin.news.index'));

    $this->assertDatabaseMissing('news', [
        'id' => $news->id,
    ]);
});

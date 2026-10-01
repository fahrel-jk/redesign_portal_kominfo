<?php

use App\Models\ServiceCategory;
use App\Models\User;

beforeEach(function () {
    $this->user = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);
});

test('admin can view categories list', function () {
    ServiceCategory::create([
        'name' => 'Kategori A',
        'slug' => 'kategori-a',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->user)->get(route('admin.categories.index'));
    $response->assertStatus(200);
    $response->assertSee('Kategori A');
});

test('admin can create new category', function () {
    $response = $this->actingAs($this->user)->post(route('admin.categories.store'), [
        'name' => 'Kategori Baru',
        'description' => 'Deskripsi Kategori Baru',
        'icon' => 'globe',
        'sort_order' => 1,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.categories.index'));
    $this->assertDatabaseHas('service_categories', [
        'name' => 'Kategori Baru',
        'slug' => 'kategori-baru',
        'icon' => 'globe',
    ]);
});

test('admin can edit and update category', function () {
    $category = ServiceCategory::create([
        'name' => 'Kategori Lama',
        'slug' => 'kategori-lama',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->user)->put(route('admin.categories.update', $category), [
        'name' => 'Kategori Diperbarui',
        'description' => 'Deskripsi Baru',
        'sort_order' => 2,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.categories.index'));
    $this->assertDatabaseHas('service_categories', [
        'id' => $category->id,
        'name' => 'Kategori Diperbarui',
        'sort_order' => 2,
    ]);
});

test('admin can toggle category active status', function () {
    $category = ServiceCategory::create([
        'name' => 'Kategori Active',
        'slug' => 'kategori-active',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->user)->patch(route('admin.categories.toggle', $category));
    $response->assertRedirect();

    expect($category->fresh()->is_active)->toBeFalse();
});

test('admin can delete category', function () {
    $category = ServiceCategory::create([
        'name' => 'Kategori Hapus',
        'slug' => 'kategori-hapus',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->user)->delete(route('admin.categories.destroy', $category));
    $response->assertRedirect(route('admin.categories.index'));

    $this->assertDatabaseMissing('service_categories', [
        'id' => $category->id,
    ]);
});

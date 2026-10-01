<?php

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;

beforeEach(function () {
    $this->user = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    $this->category = ServiceCategory::create([
        'name' => 'Infrastruktur',
        'slug' => 'infrastruktur',
        'is_active' => true,
        'sort_order' => 1,
    ]);
});

test('admin can view services list', function () {
    Service::create([
        'service_category_id' => $this->category->id,
        'name' => 'Service A',
        'slug' => 'service-a',
        'access_type' => 'domain',
        'url' => 'https://servicea.kominfo.go.id',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->user)->get(route('admin.services.index'));
    $response->assertStatus(200);
    $response->assertSee('Service A');
});

test('admin can create service with domain access type', function () {
    $response = $this->actingAs($this->user)->post(route('admin.services.store'), [
        'service_category_id' => $this->category->id,
        'name' => 'Layanan Domain Baru',
        'description' => 'Deskripsi Layanan Domain',
        'access_type' => 'domain',
        'url' => 'https://newdomain.kominfo.jatimprov.go.id',
        'sort_order' => 1,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.services.index'));
    $this->assertDatabaseHas('services', [
        'name' => 'Layanan Domain Baru',
        'access_type' => 'domain',
        'url' => 'https://newdomain.kominfo.jatimprov.go.id',
    ]);
});

test('admin can create service with path access type', function () {
    $response = $this->actingAs($this->user)->post(route('admin.services.store'), [
        'service_category_id' => $this->category->id,
        'name' => 'Layanan Path Baru',
        'description' => 'Deskripsi Layanan Path',
        'access_type' => 'path',
        'path' => 'sima-path',
        'sort_order' => 2,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.services.index'));
    $this->assertDatabaseHas('services', [
        'name' => 'Layanan Path Baru',
        'access_type' => 'path',
        'path' => '/sima-path',
    ]);
});

test('admin can edit and update service', function () {
    $service = Service::create([
        'service_category_id' => $this->category->id,
        'name' => 'Service Old',
        'slug' => 'service-old',
        'access_type' => 'domain',
        'url' => 'https://old.example.com',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->user)->put(route('admin.services.update', $service), [
        'service_category_id' => $this->category->id,
        'name' => 'Service Updated',
        'access_type' => 'path',
        'path' => '/updated-path',
        'sort_order' => 1,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.services.index'));
    $this->assertDatabaseHas('services', [
        'id' => $service->id,
        'name' => 'Service Updated',
        'access_type' => 'path',
        'path' => '/updated-path',
    ]);
});

test('admin can toggle service active status', function () {
    $service = Service::create([
        'service_category_id' => $this->category->id,
        'name' => 'Service Active Toggle',
        'slug' => 'service-active-toggle',
        'access_type' => 'domain',
        'url' => 'https://toggle.example.com',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->user)->patch(route('admin.services.toggle', $service));
    $response->assertRedirect();

    expect($service->fresh()->is_active)->toBeFalse();
});

test('admin can delete service', function () {
    $service = Service::create([
        'service_category_id' => $this->category->id,
        'name' => 'Service Delete',
        'slug' => 'service-delete',
        'access_type' => 'domain',
        'url' => 'https://delete.example.com',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->user)->delete(route('admin.services.destroy', $service));
    $response->assertRedirect(route('admin.services.index'));

    $this->assertDatabaseMissing('services', [
        'id' => $service->id,
    ]);
});

<?php

use App\Models\Service;
use App\Models\ServiceCategory;

test('public portal landing page loads successfully', function () {
    $category = ServiceCategory::create([
        'name' => 'Pelayanan Publik',
        'slug' => 'pelayanan-publik',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    Service::create([
        'service_category_id' => $category->id,
        'name' => 'SIMA Jatim',
        'slug' => 'sima-jatim',
        'description' => 'Sistem Informasi Manajemen Aset',
        'access_type' => 'path',
        'path' => '/sima',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->get(route('portal.home'));

    $response->assertStatus(200);
    $response->assertSee('SIMA Jatim');
    $response->assertSee('Pelayanan Publik');
});

test('public portal displays correct url for domain vs path access type', function () {
    $category = ServiceCategory::create([
        'name' => 'Layanan Utama',
        'slug' => 'layanan-utama',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $domainService = Service::create([
        'service_category_id' => $category->id,
        'name' => 'Domain Service',
        'slug' => 'domain-service',
        'description' => 'Test domain service',
        'access_type' => 'domain',
        'url' => 'https://subdomain.kominfo.jatimprov.go.id',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $pathService = Service::create([
        'service_category_id' => $category->id,
        'name' => 'Path Service',
        'slug' => 'path-service',
        'description' => 'Test path service',
        'access_type' => 'path',
        'path' => '/layanan-path',
        'is_active' => true,
        'sort_order' => 2,
    ]);

    expect($domainService->public_url)->toBe('https://subdomain.kominfo.jatimprov.go.id');
    expect($pathService->public_url)->toBe(url('/layanan-path'));
});

test('inactive services and categories are hidden on public portal', function () {
    $activeCategory = ServiceCategory::create([
        'name' => 'Active Category',
        'slug' => 'active-category',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $inactiveCategory = ServiceCategory::create([
        'name' => 'Inactive Category',
        'slug' => 'inactive-category',
        'is_active' => false,
        'sort_order' => 2,
    ]);

    $activeService = Service::create([
        'service_category_id' => $activeCategory->id,
        'name' => 'Active Service',
        'slug' => 'active-service',
        'access_type' => 'domain',
        'url' => 'https://active.example.com',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $inactiveService = Service::create([
        'service_category_id' => $activeCategory->id,
        'name' => 'Inactive Service',
        'slug' => 'inactive-service',
        'access_type' => 'domain',
        'url' => 'https://inactive.example.com',
        'is_active' => false,
        'sort_order' => 2,
    ]);

    $response = $this->get(route('portal.home'));

    $response->assertSee('Active Service');
    $response->assertDontSee('Inactive Service');
    $response->assertDontSee('Inactive Category');
});

test('public portal shows active news events and galleries', function () {
    // Need a category+service to avoid empty page issues
    $category = ServiceCategory::create([
        'name' => 'Cat', 'slug' => 'cat', 'is_active' => true, 'sort_order' => 1,
    ]);

    \App\Models\News::create([
        'title' => 'Berita Publik Aktif',
        'slug' => 'berita-publik-aktif',
        'category' => 'Pemerintahan',
        'summary' => 'Ringkasan berita.',
        'is_active' => true,
        'published_at' => now(),
    ]);

    \App\Models\News::create([
        'title' => 'Berita Nonaktif Hidden',
        'slug' => 'berita-nonaktif',
        'category' => 'Pemerintahan',
        'is_active' => false,
        'published_at' => now(),
    ]);

    \App\Models\Event::create([
        'title' => 'Event Publik Aktif',
        'tag' => 'Seminar',
        'event_date' => '2026-10-01',
        'is_active' => true,
    ]);

    \App\Models\Gallery::create([
        'title' => 'Galeri Publik Aktif',
        'tag' => 'Kegiatan',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $response = $this->get(route('portal.home'));

    $response->assertStatus(200);
    $response->assertSee('Berita Publik Aktif');
    $response->assertDontSee('Berita Nonaktif Hidden');
    $response->assertSee('Event Publik Aktif');
    $response->assertSee('Galeri Publik Aktif');
});

<?php

use App\Models\Event;
use App\Models\User;

beforeEach(function () {
    $this->user = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);
});

test('admin can view events list', function () {
    Event::create([
        'title' => 'Kegiatan Pertama',
        'tag' => 'Seminar',
        'event_date' => '2026-10-01',
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)->get(route('admin.events.index'));
    $response->assertStatus(200);
    $response->assertSee('Kegiatan Pertama');
});

test('admin can create event', function () {
    $response = $this->actingAs($this->user)->post(route('admin.events.store'), [
        'title' => 'Event Baru',
        'tag' => 'Workshop',
        'event_date' => '2026-10-15',
        'date_label' => '15 Okt 2026',
        'location' => 'Surabaya',
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.events.index'));
    $this->assertDatabaseHas('events', [
        'title' => 'Event Baru',
        'tag' => 'Workshop',
        'location' => 'Surabaya',
    ]);
});

test('admin can edit and update event', function () {
    $event = Event::create([
        'title' => 'Event Lama',
        'tag' => 'Seminar',
        'event_date' => '2026-10-01',
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)->put(route('admin.events.update', $event), [
        'title' => 'Event Diperbarui',
        'tag' => 'Festival',
        'event_date' => '2026-10-20',
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.events.index'));
    $this->assertDatabaseHas('events', [
        'id' => $event->id,
        'title' => 'Event Diperbarui',
        'tag' => 'Festival',
    ]);
});

test('admin can toggle event active status', function () {
    $event = Event::create([
        'title' => 'Event Toggle',
        'tag' => 'Seminar',
        'event_date' => '2026-10-01',
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)->patch(route('admin.events.toggle', $event));
    $response->assertRedirect();

    expect($event->fresh()->is_active)->toBeFalse();
});

test('admin can delete event', function () {
    $event = Event::create([
        'title' => 'Event Hapus',
        'tag' => 'Workshop',
        'event_date' => '2026-10-01',
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)->delete(route('admin.events.destroy', $event));
    $response->assertRedirect(route('admin.events.index'));

    $this->assertDatabaseMissing('events', [
        'id' => $event->id,
    ]);
});

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:100',
            'event_date' => 'required|date',
            'date_label' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = 'storage/' . $request->file('image')->store('events', 'public');
        } else {
            unset($validated['image']);
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Agenda kegiatan berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:100',
            'event_date' => 'required|date',
            'date_label' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($event->image && str_starts_with($event->image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $event->image);
                \Storage::disk('public')->delete($oldPath);
            }
            $validated['image'] = 'storage/' . $request->file('image')->store('events', 'public');
        } else {
            unset($validated['image']);
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Agenda kegiatan berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if ($event->image && str_starts_with($event->image, 'storage/')) {
            $oldPath = str_replace('storage/', '', $event->image);
            \Storage::disk('public')->delete($oldPath);
        }
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Agenda kegiatan berhasil dihapus.');
    }

    public function toggleActive(Event $event)
    {
        $event->update(['is_active' => !$event->is_active]);

        return back()->with('success', 'Status kegiatan berhasil diperbarui.');
    }
}

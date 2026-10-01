<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminNewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $news = $query->orderBy('published_at', 'desc')->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news,slug',
            'category' => 'required|string|max:100',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'read_time' => 'nullable|string|max:50',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $slugInput = $request->input('slug');
        $validated['slug'] = !empty($slugInput) ? Str::slug($slugInput) : Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $validated['read_time'] = ($validated['read_time'] ?? null) ?: '3 min baca';
        $validated['published_at'] = ($validated['published_at'] ?? null) ?: now()->toDateString();

        if ($request->hasFile('image')) {
            $validated['image'] = 'storage/' . $request->file('image')->store('news', 'public');
        } else {
            unset($validated['image']);
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news,slug,' . $news->id,
            'category' => 'required|string|max:100',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'read_time' => 'nullable|string|max:50',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $slugInput = $request->input('slug');
        $validated['slug'] = !empty($slugInput) ? Str::slug($slugInput) : Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if it's in storage
            if ($news->image && str_starts_with($news->image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $news->image);
                \Storage::disk('public')->delete($oldPath);
            }
            $validated['image'] = 'storage/' . $request->file('image')->store('news', 'public');
        } else {
            unset($validated['image']);
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if ($news->image && str_starts_with($news->image, 'storage/')) {
            $oldPath = str_replace('storage/', '', $news->image);
            \Storage::disk('public')->delete($oldPath);
        }
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function toggleActive(News $news)
    {
        $news->update(['is_active' => !$news->is_active]);

        return back()->with('success', 'Status berita berhasil diperbarui.');
    }
}

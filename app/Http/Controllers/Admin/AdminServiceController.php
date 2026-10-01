<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with('category');

        if ($request->filled('category_id')) {
            $query->where('service_category_id', $request->category_id);
        }

        if ($request->filled('access_type')) {
            $query->where('access_type', $request->access_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $services = $query->orderBy('sort_order', 'asc')->paginate(15);
        $categories = ServiceCategory::orderBy('name', 'asc')->get();

        return view('admin.services.index', compact('services', 'categories'));
    }

    public function create()
    {
        $categories = ServiceCategory::orderBy('name', 'asc')->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'description' => 'nullable|string',
            'access_type' => 'required|in:domain,path',
            'url' => 'nullable|required_if:access_type,domain|url',
            'path' => 'nullable|required_if:access_type,path|string',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $slugInput = $request->input('slug');
        $validated['slug'] = !empty($slugInput) ? Str::slug($slugInput) : Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        // Sanitize path if provided
        if ($validated['access_type'] === 'path' && !empty($validated['path'])) {
            if (!Str::startsWith($validated['path'], '/')) {
                $validated['path'] = '/' . $validated['path'];
            }
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::orderBy('name', 'asc')->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $service->id,
            'description' => 'nullable|string',
            'access_type' => 'required|in:domain,path',
            'url' => 'nullable|required_if:access_type,domain|url',
            'path' => 'nullable|required_if:access_type,path|string',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $slugInput = $request->input('slug');
        $validated['slug'] = !empty($slugInput) ? Str::slug($slugInput) : Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($validated['access_type'] === 'path' && !empty($validated['path'])) {
            if (!Str::startsWith($validated['path'], '/')) {
                $validated['path'] = '/' . $validated['path'];
            }
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }

    public function toggleActive(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        return back()->with('success', 'Status layanan berhasil diperbarui.');
    }
}

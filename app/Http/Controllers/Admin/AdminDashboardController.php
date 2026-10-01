<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_services' => Service::count(),
            'active_services' => Service::where('is_active', true)->count(),
            'inactive_services' => Service::where('is_active', false)->count(),
            'total_categories' => ServiceCategory::count(),
            'active_categories' => ServiceCategory::where('is_active', true)->count(),
            'domain_services' => Service::where('access_type', 'domain')->count(),
            'path_services' => Service::where('access_type', 'path')->count(),
            'total_users' => User::count(),
            'total_news' => News::count(),
            'active_news' => News::where('is_active', true)->count(),
            'total_events' => Event::count(),
            'active_events' => Event::where('is_active', true)->count(),
            'total_galleries' => Gallery::count(),
            'active_galleries' => Gallery::where('is_active', true)->count(),
        ];

        $recentServices = Service::with('category')->latest()->take(5)->get();
        $recentCategories = ServiceCategory::withCount('services')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentServices', 'recentCategories'));
    }
}


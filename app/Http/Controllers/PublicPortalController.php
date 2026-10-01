<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Video;
use Illuminate\Http\Request;

class PublicPortalController extends Controller
{
    public function index(Request $request)
    {
        $categories = ServiceCategory::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $services = Service::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('is_active', true);
            })
            ->orderBy('sort_order', 'asc')
            ->get();

        $totalServicesCount = Service::where('is_active', true)->count();
        $totalCategoriesCount = ServiceCategory::where('is_active', true)->count();

        $news = News::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        $events = Event::where('is_active', true)
            ->orderBy('event_date', 'asc')
            ->take(10)
            ->get();

        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();

        $videos = Video::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();

        return view('landing', compact(
            'categories', 'services', 'totalServicesCount', 'totalCategoriesCount',
            'news', 'events', 'galleries', 'videos'
        ));
    }
}


<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\PublicPortalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicPortalController::class, 'index'])->name('portal.home');

/*
|--------------------------------------------------------------------------
| Secret CMS Admin Routes (URL: /admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    // Secret Login Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Authenticated Secret Admin CMS Routes
    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Service Categories Management
        Route::patch('/categories/{category}/toggle', [AdminCategoryController::class, 'toggleActive'])->name('admin.categories.toggle');
        Route::resource('categories', AdminCategoryController::class)->names('admin.categories');

        // Services Management
        Route::patch('/services/{service}/toggle', [AdminServiceController::class, 'toggleActive'])->name('admin.services.toggle');
        Route::resource('services', AdminServiceController::class)->names('admin.services');

        // News Management
        Route::patch('/news/{news}/toggle', [AdminNewsController::class, 'toggleActive'])->name('admin.news.toggle');
        Route::resource('news', AdminNewsController::class)->names('admin.news');

        // Events Management
        Route::patch('/events/{event}/toggle', [AdminEventController::class, 'toggleActive'])->name('admin.events.toggle');
        Route::resource('events', AdminEventController::class)->names('admin.events');

        // Gallery Management
        Route::patch('/galleries/{gallery}/toggle', [AdminGalleryController::class, 'toggleActive'])->name('admin.galleries.toggle');
        Route::resource('galleries', AdminGalleryController::class)->names('admin.galleries');

        // Video Management
        Route::patch('/videos/{video}/toggle', [AdminVideoController::class, 'toggleActive'])->name('admin.videos.toggle');
        Route::resource('videos', AdminVideoController::class)->names('admin.videos');

        // Users Management
        Route::resource('users', AdminUserController::class)->names('admin.users');
    });
});

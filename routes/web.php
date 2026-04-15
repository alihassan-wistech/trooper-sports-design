<?php

use App\Http\Controllers\Admin\AnalyticsDashboardController;
use App\Http\Controllers\Admin\SeoSettingsController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('track.visitors')->group(function () {
    Route::get('/', [FrontendController::class, 'home'])->name('home');
    Route::get('/about', [FrontendController::class, 'about'])->name('about');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AnalyticsDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/analytics', [AnalyticsDashboardController::class, 'analytics'])->name('analytics');
    Route::get('/admin/seo-settings', [SeoSettingsController::class, 'index'])->name('admin.seo-settings');
    Route::patch('/admin/seo-settings/pages', [SeoSettingsController::class, 'updatePages'])->name('admin.seo-settings.pages');
    Route::patch('/admin/seo-settings/scripts', [SeoSettingsController::class, 'updateScripts'])->name('admin.seo-settings.scripts');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

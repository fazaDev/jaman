<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AgendaController;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Announcements routes
Route::prefix('pengumuman')->name('announcements.')->group(function () {
    Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    Route::get('/{slug}', [AnnouncementController::class, 'show'])->name('show');
});

// Agendas routes
Route::prefix('agenda')->name('agendas.')->group(function () {
    Route::get('/', [AgendaController::class, 'index'])->name('index');
    Route::get('/{slug}', [AgendaController::class, 'show'])->name('show');
});

// News routes
Route::prefix('berita')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/kategori/{slug}', [NewsController::class, 'category'])->name('category');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// Gallery routes
Route::prefix('galeri')->name('gallery.')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('index');
    Route::get('/foto', [GalleryController::class, 'photos'])->name('photos');
    Route::get('/video', [GalleryController::class, 'videos'])->name('videos');
});

// Special pages
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

// Dynamic pages (should be last)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');

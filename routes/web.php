<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

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

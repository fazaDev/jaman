<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Get featured content
        $featuredNews = News::published()
            ->featured()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->limit(6)
            ->get();

        // Get latest news
        $latestNews = News::published()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->limit(8)
            ->get();

        // Get active sliders with local images only
        $sliders = Slider::where('status', 'active')
            ->localImages()
            ->orderBy('sort_order')
            ->limit(5)
            ->get();
        // dd($sliders);

        // Get featured gallery items
        $galleryItems = Gallery::where('status', 'active')
            ->whereJsonContains('tags', 'featured')
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        // Get public settings
        $settings = Setting::getPublicSettings();

        return view('frontend.home', compact(
            'featuredNews',
            'latestNews',
            'sliders',
            'galleryItems',
            'settings'
        ));
    }
}

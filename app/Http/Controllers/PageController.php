<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the specified page.
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Get child pages if this is a parent page
        $childPages = Page::where('parent_id', $page->id)
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get();

        return view('frontend.pages.show', compact('page', 'childPages'));
    }

    /**
     * Display about page with special layout.
     */
    public function about()
    {
        $page = Page::where('slug', 'tentang-kami')
            ->where('status', 'published')
            ->firstOrFail();

        return view('frontend.pages.about', compact('page'));
    }

    /**
     * Display contact page.
     */
    public function contact()
    {
        $page = Page::where('slug', 'kontak')
            ->where('status', 'published')
            ->first();

        return view('frontend.pages.contact', compact('page'));
    }
}

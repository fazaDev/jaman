<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery items.
     */
    public function index(Request $request)
    {
        $query = Gallery::where('status', 'active')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc');

        // Filter by type if specified
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by category if specified
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $items = $query->paginate(16);
        
        // Get available categories
        $categories = Gallery::where('status', 'active')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort();

        return view('frontend.gallery.index', compact('items', 'categories'));
    }

    /**
     * Display photos only.
     */
    public function photos(Request $request)
    {
        $query = Gallery::where('status', 'active')
            ->where('type', 'image')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $items = $query->paginate(16);
        
        $categories = Gallery::where('status', 'active')
            ->where('type', 'image')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort();

        return view('frontend.gallery.index', compact('items'));
    }

    /**
     * Display videos only.
     */
    public function videos(Request $request)
    {
        $query = Gallery::where('status', 'active')
            ->where('type', 'video')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $items = $query->paginate(16);
        
        $categories = Gallery::where('status', 'active')
            ->where('type', 'video')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort();

        return view('frontend.gallery.index', compact('items'));
    }
}

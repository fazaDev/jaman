<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of news.
     */
    public function index(Request $request)
    {
        $query = News::published()->with(['category', 'author']);
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'like', "%{$searchTerm}%");
            });
        }
        
        // Month/Year filter
        if ($request->filled('month') && $request->filled('year')) {
            $query->whereMonth('published_at', $request->month)
                  ->whereYear('published_at', $request->year);
        }
        
        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->oldest('published_at');
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            default:
                $query->latest('published_at');
                break;
        }
        
        $news = $query->paginate(12);
        
        // Get featured news for top section
        $featuredNews = News::published()
            ->featured()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->limit(4)
            ->get();
        
        // Get categories with news count
        $categories = Category::active()
            ->withCount(['news' => function($query) {
                $query->published();
            }])
            ->orderBy('sort_order')
            ->get();
        
        // Get popular news
        $popularNews = News::published()
            ->with(['category', 'author'])
            ->orderBy('views_count', 'desc')
            ->limit(5)
            ->get();
        
        return view('frontend.news.index', compact(
            'news',
            'featuredNews',
            'categories',
            'popularNews'
        ));
    }

    /**
     * Display the specified news article.
     */
    public function show(string $slug)
    {
        $news = News::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'author'])
            ->firstOrFail();
        
        // Increment views_count
        $news->increment('views_count');
        
        // Get related news from same category
        $relatedNews = News::published()
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->limit(5)
            ->get();
        
        // Get popular news
        $popularNews = News::published()
            ->with(['category', 'author'])
            ->orderBy('views_count', 'desc')
            ->limit(5)
            ->get();
        
        // Get previous and next news
        $previousNews = News::published()
            ->where('published_at', '<', $news->published_at)
            ->orderBy('published_at', 'desc')
            ->first();
            
        $nextNews = News::published()
            ->where('published_at', '>', $news->published_at)
            ->orderBy('published_at', 'asc')
            ->first();
        
        return view('frontend.news.show', compact(
            'news',
            'relatedNews',
            'popularNews',
            'previousNews',
            'nextNews'
        ));
    }

    /**
     * Display news by category.
     */
    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
        
        $news = News::published()
            ->where('category_id', $category->id)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(12);
        
        // Get categories with news count
        $categories = Category::active()
            ->withCount(['news' => function($query) {
                $query->published();
            }])
            ->orderBy('sort_order')
            ->get();
        
        // Get popular news
        $popularNews = News::published()
            ->with(['category', 'author'])
            ->orderBy('views_count', 'desc')
            ->limit(5)
            ->get();
        
        return view('frontend.news.category', compact(
            'category',
            'news',
            'categories',
            'popularNews'
        ));
    }
}

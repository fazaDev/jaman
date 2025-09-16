<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements.
     */
    public function index()
    {
        $announcements = Announcement::published()
            ->latest('published_at')
            ->paginate(10);

        return view('frontend.announcements.index', compact('announcements'));
    }

    /**
     * Display the specified announcement.
     */
    public function show($slug)
    {
        $announcement = Announcement::where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Increment views count
        $announcement->increment('views_count');

        return view('frontend.announcements.show', compact('announcement'));
    }
}
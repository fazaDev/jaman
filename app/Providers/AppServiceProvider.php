<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share navigation data with all views
        View::composer('*', function ($view) {
            // Get main navigation pages (published root pages for main menu)
            $mainMenuPages = Page::published()
                ->root()
                ->orderBy('sort_order')
                ->orderBy('title')
                ->with(['children' => function ($query) {
                    $query->where('status', 'published')
                          ->orderBy('sort_order')
                          ->orderBy('title');
                }])
                ->get();

            $view->with('mainMenuPages', $mainMenuPages);
        });
    }
}

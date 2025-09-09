<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestNewsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-news-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test news data for debugging';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing news template rendering...');
        
        // Simulate the controller behavior
        $query = \App\Models\News::published()->with(['category', 'author']);
        $news = $query->paginate(12);
        
        // Get featured news for top section
        $featuredNews = \App\Models\News::published()
            ->featured()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->limit(4)
            ->get();
            
        $this->info('News count: ' . $news->count());
        $this->info('Featured news count: ' . $featuredNews->count());
        
        // Test the variable scope issue
        $originalNews = $news;
        
        // Simulate the foreach loop in featured news section
        foreach ($featuredNews as $featuredItem) {
            // This was the problematic line where $news was being overwritten
            $this->info('Featured item: ' . $featuredItem->title);
        }
        
        // Check if $news is still the original collection
        $this->info('After featured loop - News is still paginator: ' . ($news === $originalNews ? 'YES' : 'NO'));
        $this->info('News type after featured loop: ' . gettype($news));
        
        // Now test the main news loop
        if ($news->count() > 0) {
            foreach ($news as $newsItem) {
                $this->info('Main news item: ' . $newsItem->title . ' (type: ' . gettype($newsItem) . ')');
                $this->info('Has featured_image property: ' . (property_exists($newsItem, 'featured_image') ? 'YES' : 'NO'));
                break; // Just test the first one
            }
        }
        
        $this->info('Test completed successfully!');
    }
}

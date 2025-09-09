<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestHomepage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-homepage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test homepage controller and slider data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing homepage data...');
        
        // Test slider query directly
        $sliders = \App\Models\Slider::where('status', 'active')
            ->orderBy('sort_order')
            ->limit(5)
            ->get();
            
        $this->info('Active sliders found: ' . $sliders->count());
        
        foreach ($sliders as $slider) {
            $this->info('- ' . $slider->title . ' (Order: ' . $slider->sort_order . ', Status: ' . $slider->status . ')');
        }
        
        // Test controller method
        try {
            $controller = new \App\Http\Controllers\HomeController();
            $response = $controller->index();
            
            // Extract view data
            $data = $response->getData();
            
            $this->info('\nController response data:');
            $this->info('Sliders in view data: ' . (isset($data['sliders']) ? $data['sliders']->count() : 'NOT SET'));
            
            if (isset($data['sliders'])) {
                foreach ($data['sliders'] as $slider) {
                    $this->info('- View slider: ' . $slider->title);
                }
            }
            
        } catch (\Exception $e) {
            $this->error('Controller test failed: ' . $e->getMessage());
        }
    }
}

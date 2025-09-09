<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestFileUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-file-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test file upload configuration and storage setup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing file upload configuration...');
        
        // Test storage configuration
        $this->info('Default disk: ' . config('filesystems.default'));
        $this->info('Public disk root: ' . config('filesystems.disks.public.root'));
        $this->info('Public disk URL: ' . config('filesystems.disks.public.url'));
        
        // Test storage directories
        $directories = ['sliders', 'pages', 'gallery', 'gallery/thumbnails', 'settings'];
        foreach ($directories as $dir) {
            $path = storage_path('app/public/' . $dir);
            if (is_dir($path)) {
                $this->info('✓ Directory exists: ' . $dir);
            } else {
                $this->error('✗ Directory missing: ' . $dir);
            }
        }
        
        // Test symlink
        $symlinkPath = public_path('storage');
        if (is_link($symlinkPath) || is_dir($symlinkPath)) {
            $this->info('✓ Storage symlink exists');
        } else {
            $this->error('✗ Storage symlink missing');
        }
        
        // Test write permissions
        $testFile = storage_path('app/public/test.txt');
        try {
            file_put_contents($testFile, 'test');
            if (file_exists($testFile)) {
                $this->info('✓ Write permissions OK');
                unlink($testFile);
            } else {
                $this->error('✗ Cannot write to storage');
            }
        } catch (Exception $e) {
            $this->error('✗ Write test failed: ' . $e->getMessage());
        }
        
        $this->info('File upload test complete.');
    }
}

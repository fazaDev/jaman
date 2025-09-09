<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Portfolio Images
        Gallery::create([
            'title' => 'Modern Office Design',
            'description' => 'Contemporary office space with minimalist design and natural lighting.',
            'type' => 'image',
            'file_path' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&h=600&fit=crop',
            'alt_text' => 'Modern office interior design',
            'category' => 'portfolio',
            'status' => 'active',
            'sort_order' => 1,
            'tags' => ['office', 'design', 'modern', 'interior'],
            'metadata' => [
                'width' => 800,
                'height' => 600,
                'size' => 156000,
            ],
        ]);

        Gallery::create([
            'title' => 'Creative Workspace',
            'description' => 'Inspiring workspace designed for creativity and collaboration.',
            'type' => 'image',
            'file_path' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=800&h=600&fit=crop',
            'alt_text' => 'Creative workspace design',
            'category' => 'portfolio',
            'status' => 'active',
            'sort_order' => 2,
            'tags' => ['workspace', 'creative', 'collaboration'],
            'metadata' => [
                'width' => 800,
                'height' => 600,
                'size' => 142000,
            ],
        ]);

        // Team Photos
        Gallery::create([
            'title' => 'Team Meeting',
            'description' => 'Our team collaborating on exciting new projects.',
            'type' => 'image',
            'file_path' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop',
            'alt_text' => 'Team members in a meeting',
            'category' => 'team',
            'status' => 'active',
            'sort_order' => 3,
            'tags' => ['team', 'meeting', 'collaboration', 'work'],
            'metadata' => [
                'width' => 800,
                'height' => 600,
                'size' => 178000,
            ],
        ]);

        Gallery::create([
            'title' => 'Company Event',
            'description' => 'Annual company celebration with team building activities.',
            'type' => 'image',
            'file_path' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800&h=600&fit=crop',
            'alt_text' => 'Company event celebration',
            'category' => 'events',
            'status' => 'active',
            'sort_order' => 4,
            'tags' => ['event', 'celebration', 'team', 'company'],
            'metadata' => [
                'width' => 800,
                'height' => 600,
                'size' => 165000,
            ],
        ]);

        // Product Images
        Gallery::create([
            'title' => 'Product Showcase',
            'description' => 'High-quality product photography showcasing our latest offerings.',
            'type' => 'image',
            'file_path' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop',
            'alt_text' => 'Product showcase photography',
            'category' => 'products',
            'status' => 'active',
            'sort_order' => 5,
            'tags' => ['product', 'showcase', 'photography'],
            'metadata' => [
                'width' => 800,
                'height' => 600,
                'size' => 134000,
            ],
        ]);

        // Video Content
        Gallery::create([
            'title' => 'Company Introduction Video',
            'description' => 'An overview of our company culture, values, and mission.',
            'type' => 'video',
            'file_path' => 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4',
            'thumbnail_path' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&h=600&fit=crop',
            'alt_text' => 'Company introduction video thumbnail',
            'category' => 'general',
            'status' => 'active',
            'sort_order' => 6,
            'tags' => ['video', 'introduction', 'company', 'culture'],
            'metadata' => [
                'width' => 1280,
                'height' => 720,
                'duration' => 185, // 3:05 minutes
                'size' => 1048576, // 1MB
                'format' => 'mp4',
            ],
        ]);

        Gallery::create([
            'title' => 'Product Demo Video',
            'description' => 'Demonstration of our flagship product features and capabilities.',
            'type' => 'video',
            'file_path' => 'https://sample-videos.com/zip/10/mp4/SampleVideo_640x360_1mb.mp4',
            'thumbnail_path' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop',
            'alt_text' => 'Product demonstration video thumbnail',
            'category' => 'products',
            'status' => 'active',
            'sort_order' => 7,
            'tags' => ['video', 'demo', 'product', 'features'],
            'metadata' => [
                'width' => 640,
                'height' => 360,
                'duration' => 125, // 2:05 minutes
                'size' => 1048576, // 1MB
                'format' => 'mp4',
            ],
        ]);

        // Office Environment
        Gallery::create([
            'title' => 'Office Reception Area',
            'description' => 'Welcoming reception area with modern design elements.',
            'type' => 'image',
            'file_path' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=800&h=600&fit=crop',
            'alt_text' => 'Modern office reception area',
            'category' => 'office',
            'status' => 'active',
            'sort_order' => 8,
            'tags' => ['office', 'reception', 'modern', 'design'],
            'metadata' => [
                'width' => 800,
                'height' => 600,
                'size' => 189000,
            ],
        ]);

        // Inactive item for testing
        Gallery::create([
            'title' => 'Behind the Scenes',
            'description' => 'Behind the scenes footage from our latest project.',
            'type' => 'video',
            'file_path' => 'https://sample-videos.com/zip/10/mp4/SampleVideo_720x480_1mb.mp4',
            'thumbnail_path' => 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?w=800&h=600&fit=crop',
            'alt_text' => 'Behind the scenes video thumbnail',
            'category' => 'general',
            'status' => 'inactive',
            'sort_order' => 9,
            'tags' => ['video', 'behind-scenes', 'project'],
            'metadata' => [
                'width' => 720,
                'height' => 480,
                'duration' => 95, // 1:35 minutes
                'size' => 1048576, // 1MB
                'format' => 'mp4',
            ],
        ]);
    }
}

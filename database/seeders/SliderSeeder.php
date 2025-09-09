<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample sliders for the homepage
        Slider::create([
            'title' => 'Welcome to Our Website',
            'description' => 'Discover amazing products and services that will transform your business experience.',
            'image_path' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=1200&h=600&fit=crop',
            'button_text' => 'Get Started',
            'button_url' => '/services',
            'button_new_tab' => false,
            'status' => 'active',
            'sort_order' => 1,
            'settings' => [
                'overlay_opacity' => 0.4,
                'text_position' => 'center',
                'animation_type' => 'fade',
            ],
        ]);

        Slider::create([
            'title' => 'Professional Solutions',
            'description' => 'We provide cutting-edge solutions tailored to your unique business needs and goals.',
            'image_path' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&h=600&fit=crop',
            'button_text' => 'Learn More',
            'button_url' => '/about',
            'button_new_tab' => false,
            'status' => 'active',
            'sort_order' => 2,
            'settings' => [
                'overlay_opacity' => 0.5,
                'text_position' => 'left',
                'animation_type' => 'slide',
            ],
        ]);

        Slider::create([
            'title' => 'Innovation & Excellence',
            'description' => 'Join thousands of satisfied customers who trust our innovative approach to deliver results.',
            'image_path' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=1200&h=600&fit=crop',
            'button_text' => 'Contact Us',
            'button_url' => '/contact',
            'button_new_tab' => false,
            'status' => 'active',
            'sort_order' => 3,
            'settings' => [
                'overlay_opacity' => 0.6,
                'text_position' => 'right',
                'animation_type' => 'zoom',
            ],
        ]);

        Slider::create([
            'title' => 'Global Partnership',
            'description' => 'Expand your reach with our international network and strategic partnerships worldwide.',
            'image_path' => 'https://images.unsplash.com/photo-1573164713988-8665fc963095?w=1200&h=600&fit=crop',
            'button_text' => 'View Portfolio',
            'button_url' => '/portfolio',
            'button_new_tab' => true,
            'status' => 'active',
            'sort_order' => 4,
            'settings' => [
                'overlay_opacity' => 0.3,
                'text_position' => 'center',
                'animation_type' => 'fade',
            ],
        ]);

        // Create an inactive slider for testing
        Slider::create([
            'title' => 'Special Promotion',
            'description' => 'Limited time offer - Get 50% off on all premium services this month only!',
            'image_path' => 'https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=1200&h=600&fit=crop',
            'button_text' => 'Claim Offer',
            'button_url' => '/promotion',
            'button_new_tab' => false,
            'status' => 'inactive',
            'sort_order' => 5,
            'settings' => [
                'overlay_opacity' => 0.7,
                'text_position' => 'center',
                'animation_type' => 'bounce',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main/root pages
        $homePage = Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'content' => '<h1>Welcome to Our Website</h1><p>This is the home page content.</p>',
            'meta_description' => 'Welcome to our website homepage',
            'meta_keywords' => 'home, welcome, website',
            'status' => 'published',
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        $aboutPage = Page::create([
            'title' => 'About Us',
            'slug' => 'about',
            'content' => '<h1>About Our Company</h1><p>Learn more about our company and mission.</p>',
            'meta_description' => 'Learn about our company, mission, and values',
            'meta_keywords' => 'about, company, mission, values',
            'status' => 'published',
            'sort_order' => 2,
        ]);

        $servicesPage = Page::create([
            'title' => 'Services',
            'slug' => 'services',
            'content' => '<h1>Our Services</h1><p>Discover the services we offer.</p>',
            'meta_description' => 'Explore our comprehensive range of services',
            'meta_keywords' => 'services, solutions, offerings',
            'status' => 'published',
            'sort_order' => 3,
        ]);

        $contactPage = Page::create([
            'title' => 'Contact',
            'slug' => 'contact',
            'content' => '<h1>Contact Us</h1><p>Get in touch with our team.</p>',
            'meta_description' => 'Contact us for inquiries and support',
            'meta_keywords' => 'contact, support, inquiries',
            'status' => 'published',
            'sort_order' => 4,
        ]);

        // Create child pages for About
        Page::create([
            'title' => 'Our Team',
            'slug' => 'our-team',
            'content' => '<h1>Our Team</h1><p>Meet our dedicated team members.</p>',
            'meta_description' => 'Meet our professional team members',
            'meta_keywords' => 'team, staff, professionals',
            'status' => 'published',
            'parent_id' => $aboutPage->id,
            'sort_order' => 1,
        ]);

        Page::create([
            'title' => 'Our History',
            'slug' => 'our-history',
            'content' => '<h1>Our History</h1><p>Learn about our company\'s journey.</p>',
            'meta_description' => 'Discover our company history and milestones',
            'meta_keywords' => 'history, journey, milestones',
            'status' => 'published',
            'parent_id' => $aboutPage->id,
            'sort_order' => 2,
        ]);

        // Create child pages for Services
        $webDev = Page::create([
            'title' => 'Web Development',
            'slug' => 'web-development',
            'content' => '<h1>Web Development Services</h1><p>Professional web development solutions.</p>',
            'meta_description' => 'Professional web development services and solutions',
            'meta_keywords' => 'web development, websites, programming',
            'status' => 'published',
            'parent_id' => $servicesPage->id,
            'sort_order' => 1,
        ]);

        Page::create([
            'title' => 'Mobile Apps',
            'slug' => 'mobile-apps',
            'content' => '<h1>Mobile App Development</h1><p>Custom mobile application development.</p>',
            'meta_description' => 'Custom mobile app development services',
            'meta_keywords' => 'mobile apps, development, iOS, Android',
            'status' => 'published',
            'parent_id' => $servicesPage->id,
            'sort_order' => 2,
        ]);

        $consulting = Page::create([
            'title' => 'Consulting',
            'slug' => 'consulting',
            'content' => '<h1>IT Consulting</h1><p>Expert IT consulting services.</p>',
            'meta_description' => 'Expert IT consulting and advisory services',
            'meta_keywords' => 'consulting, IT, advisory, expert',
            'status' => 'published',
            'parent_id' => $servicesPage->id,
            'sort_order' => 3,
        ]);

        // Create sub-child pages for Web Development
        Page::create([
            'title' => 'Frontend Development',
            'slug' => 'frontend-development',
            'content' => '<h1>Frontend Development</h1><p>Modern frontend development with React, Vue, and more.</p>',
            'meta_description' => 'Professional frontend development services',
            'meta_keywords' => 'frontend, React, Vue, JavaScript',
            'status' => 'published',
            'parent_id' => $webDev->id,
            'sort_order' => 1,
        ]);

        Page::create([
            'title' => 'Backend Development',
            'slug' => 'backend-development',
            'content' => '<h1>Backend Development</h1><p>Robust backend solutions with Laravel, Node.js, and more.</p>',
            'meta_description' => 'Professional backend development services',
            'meta_keywords' => 'backend, Laravel, Node.js, API',
            'status' => 'published',
            'parent_id' => $webDev->id,
            'sort_order' => 2,
        ]);

        // Create a draft page
        Page::create([
            'title' => 'Coming Soon',
            'slug' => 'coming-soon',
            'content' => '<h1>Coming Soon</h1><p>This page is under construction.</p>',
            'meta_description' => 'Page under construction - coming soon',
            'meta_keywords' => 'coming soon, under construction',
            'status' => 'draft',
            'sort_order' => 5,
        ]);
    }
}

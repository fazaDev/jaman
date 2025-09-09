<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'PUPR Portal',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Name of the website',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'site_description',
                'value' => 'Portal Resmi Kementerian Pekerjaan Umum dan Perumahan Rakyat',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'Brief description of the website',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'site_logo',
                'value' => '/images/logo.png',
                'type' => 'file',
                'group' => 'general',
                'description' => 'Website logo',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'maintenance_mode',
                'value' => 'false',
                'type' => 'boolean',
                'group' => 'general',
                'description' => 'Enable maintenance mode',
                'is_public' => false,
                'sort_order' => 4,
            ],

            // Contact Information
            [
                'key' => 'contact_address',
                'value' => 'Jl. Pattimura No. 20, Jakarta Selatan 12110',
                'type' => 'textarea',
                'group' => 'contact',
                'description' => 'Office address',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+62 21 7251581',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Primary phone number',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@pu.go.id',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Primary email address',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'contact_fax',
                'value' => '+62 21 7251581',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Fax number',
                'is_public' => true,
                'sort_order' => 4,
            ],

            // Social Media
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Facebook page URL',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Twitter profile URL',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Instagram profile URL',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://youtube.com/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'YouTube channel URL',
                'is_public' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'LinkedIn company page URL',
                'is_public' => true,
                'sort_order' => 5,
            ],

            // SEO Settings
            [
                'key' => 'seo_meta_title',
                'value' => 'PUPR Portal - Kementerian Pekerjaan Umum dan Perumahan Rakyat',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Default meta title',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'seo_meta_description',
                'value' => 'Portal resmi Kementerian Pekerjaan Umum dan Perumahan Rakyat Indonesia. Informasi terkini tentang infrastruktur, perumahan, dan pembangunan.',
                'type' => 'textarea',
                'group' => 'seo',
                'description' => 'Default meta description',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'seo_keywords',
                'value' => 'PUPR, infrastruktur, perumahan, pembangunan, kementerian, pekerjaan umum',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Default keywords',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'google_analytics_id',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Google Analytics tracking ID',
                'is_public' => false,
                'sort_order' => 4,
            ],

            // Appearance
            [
                'key' => 'theme_primary_color',
                'value' => '#1f2937',
                'type' => 'text',
                'group' => 'appearance',
                'description' => 'Primary theme color',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'theme_secondary_color',
                'value' => '#f59e0b',
                'type' => 'text',
                'group' => 'appearance',
                'description' => 'Secondary theme color',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'items_per_page',
                'value' => '10',
                'type' => 'number',
                'group' => 'appearance',
                'description' => 'Number of items to show per page',
                'is_public' => true,
                'sort_order' => 3,
            ],

            // Email Settings
            [
                'key' => 'admin_email',
                'value' => 'admin@pu.go.id',
                'type' => 'text',
                'group' => 'email',
                'description' => 'Administrator email address',
                'is_public' => false,
                'sort_order' => 1,
            ],
            [
                'key' => 'notification_email',
                'value' => 'notifications@pu.go.id',
                'type' => 'text',
                'group' => 'email',
                'description' => 'Email for system notifications',
                'is_public' => false,
                'sort_order' => 2,
            ],

            // API Configuration
            [
                'key' => 'api_timeout',
                'value' => '30',
                'type' => 'number',
                'group' => 'api',
                'description' => 'API request timeout in seconds',
                'is_public' => false,
                'sort_order' => 1,
            ],
            [
                'key' => 'max_upload_size',
                'value' => '10',
                'type' => 'number',
                'group' => 'api',
                'description' => 'Maximum file upload size in MB',
                'is_public' => false,
                'sort_order' => 2,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}

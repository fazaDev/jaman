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
                'value' => 'Dinas Pekerjaan Umum dan Prumahan Rakyat Provinsi Jambi',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Nama website',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'site_description',
                'value' => 'Pemerintah Provinsi Jambi',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'Deskripsi singkat tentang website',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'site_logo',
                'value' => '/images/logo-pemprov.png',
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
                'description' => 'Pemencegahan akses publik saat pemeliharaan',
                'is_public' => false,
                'sort_order' => 4,
            ],

            // Contact Information
            [
                'key' => 'contact_address',
                'value' => 'Jl. H. Agus Salim No. 2, Kota Baru, Kota Jambi, Jambi 36128',
                'type' => 'textarea',
                'group' => 'contact',
                'description' => 'Alamat lengkap',
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
                'value' => 'humaspuprprovinsijambi@gmail.com',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Alamat email',
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
                'value' => 'https://www.facebook.com/dinaspuprovinsijambi/',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Facebook page URL',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'social_twitter',
                'value' => 'http://twitter.com/@DINASPUPRJAMBI',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Twitter profile URL',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://www.instagram.com/dinaspuprovinsijambi/',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Instagram profile URL',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://www.youtube.com/channel/UCPOFLprnEmkqVZ8ITX4tf7A',
                'type' => 'text',
                'group' => 'social',
                'description' => 'YouTube channel URL',
                'is_public' => true,
                'sort_order' => 4,
            ],

            // SEO Settings
            [
                'key' => 'seo_meta_title',
                'value' => 'Dinas Pekerjaan Umum dan Perumahan Rakyat Provinsi Jambi',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Default meta title',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'seo_meta_description',
                'value' => 'Dinas Pekerjaan Umum dan Perumahan Rakyat Provinsi Jambi',
                'type' => 'textarea',
                'group' => 'seo',
                'description' => 'Default meta description',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'seo_keywords',
                'value' => 'PUPR, infrastruktur, perumahan, pembangunan, jambi, dinas, pemerintah',
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

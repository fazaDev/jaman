<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Define social media settings to add
        $socialSettings = [
            [
                'key' => 'social.facebook',
                'value' => 'https://facebook.com/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Facebook page URL',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'social.twitter',
                'value' => 'https://twitter.com/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Twitter profile URL',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'social.instagram',
                'value' => 'https://instagram.com/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Instagram profile URL',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'social.youtube',
                'value' => 'https://youtube.com/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'YouTube channel URL',
                'is_public' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'social.linkedin',
                'value' => 'https://linkedin.com/company/kemenpu',
                'type' => 'text',
                'group' => 'social',
                'description' => 'LinkedIn company page URL',
                'is_public' => true,
                'sort_order' => 5,
            ],
        ];
        
        // Insert the social media settings
        foreach ($socialSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Define keys to remove
        $keysToRemove = [
            'social.facebook',
            'social.twitter',
            'social.instagram',
            'social.youtube',
            'social.linkedin',
        ];
        
        // Remove the social media settings
        foreach ($keysToRemove as $key) {
            Setting::where('key', $key)->delete();
        }
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Slider;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable sliders that use external URLs
        Slider::where('image_path', 'LIKE', 'http://%')
            ->orWhere('image_path', 'LIKE', 'https://%')
            ->update(['status' => 'inactive']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-enable external URL sliders
        Slider::where('image_path', 'LIKE', 'http://%')
            ->orWhere('image_path', 'LIKE', 'https://%')
            ->update(['status' => 'active']);
    }
};

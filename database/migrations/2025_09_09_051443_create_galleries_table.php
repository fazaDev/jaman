<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['image', 'video']); // Define if it's photo or video
            $table->string('file_path'); // Path to the image or video file
            $table->string('thumbnail_path')->nullable(); // Thumbnail for videos
            $table->string('alt_text')->nullable(); // Alt text for accessibility
            $table->json('metadata')->nullable(); // Store video duration, dimensions, etc.
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sort_order')->default(0);
            $table->string('category')->nullable(); // Category for grouping
            $table->json('tags')->nullable(); // Tags for filtering
            $table->timestamps();
            
            $table->index(['type', 'status']);
            $table->index(['category', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};

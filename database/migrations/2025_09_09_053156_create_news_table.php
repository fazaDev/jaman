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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('allow_comments')->default(true);
            $table->json('meta_data')->nullable(); // SEO data
            $table->json('tags')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->integer('views_count')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['status', 'published_at']);
            $table->index(['category_id', 'status']);
            $table->index(['is_featured', 'status']);
            $table->index('author_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->json('seo_data')->nullable();
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('pages')->onDelete('cascade');
            $table->index(['status', 'parent_id']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

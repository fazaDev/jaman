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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, number, boolean, file, json
            $table->string('group')->nullable(); // For grouping settings
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false); // For frontend access
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['group', 'sort_order']);
            $table->index('is_public');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

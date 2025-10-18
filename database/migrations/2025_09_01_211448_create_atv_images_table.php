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
        Schema::create('atv_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atv_id')->constrained()->onDelete('cascade');
            $table->string('url');
            $table->string('type')->default('image'); // image, video
            $table->string('alt_text')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['atv_id', 'type']);
            $table->index(['atv_id', 'is_primary']);
            $table->index(['atv_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atv_images');
    }
};

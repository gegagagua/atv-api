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
        Schema::create('atvs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('year');
            $table->string('clearance');
            $table->integer('mileage');
            $table->string('transmission');
            $table->string('fuel');
            $table->boolean('isActive')->default(true);
            $table->boolean('isVip')->default(false);
            $table->string('engine');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atvs');
    }
};

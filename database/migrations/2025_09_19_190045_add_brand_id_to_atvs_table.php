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
        Schema::table('atvs', function (Blueprint $table) {
            $table->foreignId('brand_id')->nullable()->after('user_id')->constrained()->onDelete('set null');
            $table->index('brand_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atvs', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropIndex(['brand_id']);
            $table->dropColumn('brand_id');
        });
    }
};

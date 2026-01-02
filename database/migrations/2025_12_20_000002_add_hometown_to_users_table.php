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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('hometown_city_id')->nullable()->after('preferred_position')->constrained('cities')->nullOnDelete();
            $table->boolean('show_hometown')->default(false)->after('hometown_city_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['hometown_city_id']);
            $table->dropColumn(['hometown_city_id', 'show_hometown']);
        });
    }
};


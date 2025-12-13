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
            $table->integer('goals')->default(0)->after('password');
            $table->integer('assists')->default(0)->after('goals');
            $table->decimal('rating', 5, 2)->default(0)->after('assists');
            $table->string('referral_code')->unique()->nullable()->after('rating');
            $table->foreignId('referred_by_id')->nullable()->after('referral_code')->constrained('users')->nullOnDelete();
            $table->integer('referrals_count')->default(0)->after('referred_by_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['referred_by_id']);
            $table->dropColumn(['goals', 'assists', 'rating', 'referral_code', 'referred_by_id', 'referrals_count']);
        });
    }
};

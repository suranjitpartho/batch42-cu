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
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('home_district')->nullable()->after('country');
            $table->string('emergency_contact')->nullable()->after('phone_number');
            $table->string('hobby')->nullable()->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['instagram_url', 'home_district', 'emergency_contact', 'hobby']);
        });
    }
};

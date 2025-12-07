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
        Schema::create('university_infos', function (Blueprint $table) {
            $table->id();
            $table->text('university_history')->nullable();
            $table->text('university_mission')->nullable();
            $table->text('university_vision')->nullable();
            $table->text('batch_info')->nullable();
            $table->string('university_main_photo_path')->nullable();
            $table->string('university_detail_photo_1_path')->nullable();
            $table->string('university_detail_photo_2_path')->nullable();
            $table->string('university_detail_photo_3_path')->nullable();
            $table->string('university_detail_photo_4_path')->nullable();
            $table->string('university_detail_photo_5_path')->nullable();
            $table->string('batch_detail_photo_1_path')->nullable();
            $table->string('batch_detail_photo_2_path')->nullable();
            $table->string('batch_detail_photo_3_path')->nullable();
            $table->string('batch_detail_photo_4_path')->nullable();
            $table->string('batch_detail_photo_5_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_infos');
    }
};
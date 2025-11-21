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
        Schema::create('constitutions', function (Blueprint $table) {
            $table->id();
            $table->string('chapter_number'); // e.g., "Chapter 1" or "1"
            $table->json('chapter_name'); // Translatable: {"en": "Name", "bn": "নাম"}
            $table->json('content');      // Translatable: {"en": "Content...", "bn": "বিষয়বস্তু..."}
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constitutions');
    }
};

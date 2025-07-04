<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pandit_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable(); // e.g., "Expert in Vedic rituals"
            $table->text('description')->nullable(); // e.g., "25+ years of experience..."
            $table->string('specialization')->nullable();
            $table->float('rating')->default(5.0);
            $table->integer('experience_years')->default(0);
            $table->string('phone')->nullable();
            $table->text('expertise_areas')->nullable(); // JSON array of areas
            $table->text('languages_known')->nullable(); // JSON array of languages
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_available')->default(true);
            $table->integer('completed_pujas')->default(0);
            $table->integer('total_reviews')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pandit_details');
    }
}; 
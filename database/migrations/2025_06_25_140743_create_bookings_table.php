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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('puja_type');
            $table->string('pandit_name');
            $table->string('pandit_quality')->nullable();
            $table->float('pandit_rating')->nullable();
            $table->string('pandit_phone')->nullable();
            $table->date('booking_date');
            $table->string('booking_time');
            $table->string('status')->default('Reserved'); // e.g., Reserved, Completed, Canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

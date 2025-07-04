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
            $table->string('mobile')->nullable()->after('email');
            $table->date('dob')->nullable()->after('mobile');
            $table->text('address')->nullable()->after('dob');
            $table->string('role')->default('user')->after('address');
            $table->string('phone')->nullable();
            $table->integer('experience')->nullable();
            $table->text('specializations')->nullable();
            $table->text('languages')->nullable();
            $table->text('bio')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('travel_distance')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('id_proof')->nullable();
            $table->text('certificates')->nullable();
            $table->boolean('profile_completed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'mobile',
                'dob',
                'address',
                'role',
                'phone',
                'experience',
                'specializations',
                'languages',
                'bio',
                'city',
                'state',
                'travel_distance',
                'profile_picture',
                'id_proof',
                'certificates',
                'profile_completed'
            ]);
        });
    }
}; 
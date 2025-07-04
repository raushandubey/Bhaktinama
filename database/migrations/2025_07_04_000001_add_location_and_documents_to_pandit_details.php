<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pandit_details', function (Blueprint $table) {
            $table->string('city')->nullable()->after('phone');
            $table->string('state')->nullable()->after('city');
            $table->text('address')->nullable()->after('state');
            $table->integer('travel_distance')->default(0)->after('address');
            $table->string('id_proof')->nullable()->after('travel_distance');
            $table->text('certificates')->nullable()->after('id_proof');
        });
    }

    public function down()
    {
        Schema::table('pandit_details', function (Blueprint $table) {
            $table->dropColumn([
                'city',
                'state',
                'address',
                'travel_distance',
                'id_proof',
                'certificates'
            ]);
        });
    }
}; 
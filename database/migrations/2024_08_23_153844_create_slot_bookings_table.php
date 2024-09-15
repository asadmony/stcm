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
        Schema::create('slot_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('district_id')->unsigned()->nullable();
            $table->integer('thana_id')->unsigned()->nullable();
            $table->bigInteger('zone_id')->unsigned()->nullable();
            $table->bigInteger('traffic_point_id')->unsigned()->nullable();
            $table->bigInteger('shift_id')->unsigned()->nullable();
            $table->date('date')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_bookings');
    }
};

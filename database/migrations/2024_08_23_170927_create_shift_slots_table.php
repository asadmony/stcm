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
        Schema::create('shift_slots', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('thana_id')->unsigned()->nullable();
            $table->bigInteger('zone_id')->unsigned()->nullable();
            $table->foreignId('traffic_point_id')->constrained()->onDelete('cascade')->default(1);
            $table->foreignId('shift_id')->constrained()->onDelete('cascade')->default(1);
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('slots')->unsigned()->nullable()->default(5);
            $table->boolean('active')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_slots');
    }
};

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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nid')->nullable();
            $table->string('nid_photo')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('birth_certificate_photo')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mobile_no', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('education_institute')->nullable();
            $table->string('education_level')->nullable();
            $table->string('education_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};

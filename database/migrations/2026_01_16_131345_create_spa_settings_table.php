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

        Schema::create('spa_settings', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('contact_number');
            $table->string('logo');
            $table->integer('maximum_bed_capacity');
            $table->integer('booking_buffer_start');
            $table->integer('booking_buffer_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spa_settings');
    }
};

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
        Schema::create('spa_weekly_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spa_id')->constrained()->cascadeOnDelete();
            $table->string('day_of_week');
            $table->time('open_time');
            $table->time('close_time');
            $table->integer('is_closed');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spa_weekly_schedules');
    }
};

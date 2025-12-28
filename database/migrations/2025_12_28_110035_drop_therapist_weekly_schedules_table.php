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
        Schema::dropIfExists('therapist_weekly_schedules');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('therapist_weekly_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spa_id')->constrained('spas')->cascadeOnDelete();
            $table->foreignId('therapist_id')->constrained('users')->cascadeOnDelete();
            $table->enum('day_of_week', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_unavailable')->default(false);
            $table->boolean('is_current')->default(true);
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }
};

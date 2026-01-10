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
        Schema::table('spa_weekly_schedules', function (Blueprint $table) {
            $table->unique(
                ['spa_id', 'day_of_week', 'start_time', 'end_time'],
                'spa_weekly_time_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spa_weekly_schedules', function (Blueprint $table) {
            //
        });
    }
};

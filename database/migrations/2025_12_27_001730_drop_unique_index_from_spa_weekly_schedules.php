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
            $table->dropUnique('spa_weekly_schedules_spa_id_day_of_week_is_current_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spa_weekly_schedules', function (Blueprint $table) {
            // Re-add the UNIQUE index (not recommended, but required for rollback)
            $table->unique(
                ['spa_id', 'day_of_week', 'is_current'],
                'spa_weekly_schedules_spa_id_day_of_week_is_current_unique'
            );

            // Remove the non-unique index
            $table->dropIndex('spa_weekly_schedules_lookup_index');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('user_weekly_schedules', 'staff_weekly_schedules');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('staff_weekly_schedules', 'user_weekly_schedules');
    }
};

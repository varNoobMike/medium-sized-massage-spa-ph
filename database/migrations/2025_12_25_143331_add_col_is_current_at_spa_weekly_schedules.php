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
            $table->integer('is_current')->default(0)->after('is_closed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spa_weekly_schedules', function (Blueprint $table) {
            $table->dropColumn('is_current');
        });
    }
};

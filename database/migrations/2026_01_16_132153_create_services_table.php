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

        /*
        'spa_id',
        'name',
        'duration_minutes',
        'price',
        'description',
        */

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spa_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('duration_minutes');
            $table->decimal('price', 10, 2);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->unique(['spa_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

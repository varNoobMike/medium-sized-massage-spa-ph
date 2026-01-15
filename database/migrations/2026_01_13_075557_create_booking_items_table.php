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
        Schema::create('booking_services', function (Blueprint $table) {

            $table->id();

            $table->foreignId('booking_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('service_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('therapist_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Duration in minutes
            $table->integer('duration');

            // Service price
            $table->decimal('price', 10, 2);

            // Optional notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // Prevent duplicate service per booking
            $table->unique(['booking_id', 'service_id', 'therapist_id']);
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_items');
    }
};

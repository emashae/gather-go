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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id'); 
            $table->unsignedBigInteger('attendee_id'); 
            $table->decimal('price', 8, 2); 
            $table->enum('status', ['booked', 'cancelled']); 
            $table->timestamps(); 

            // Foreign key constraints
            //$table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            //$table->foreign('attendee_id')->references('id')->on('users')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

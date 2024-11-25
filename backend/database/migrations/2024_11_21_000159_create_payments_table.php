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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id'); 
            $table->decimal('amount', 8, 2); 
            $table->enum('payment_method', ['credit_card', 'paypal', 'bank_transfer']); 
            $table->enum('status', ['pending', 'completed', 'failed']); 
            $table->timestamps(); 

            // Foreign key constraint
            //$table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

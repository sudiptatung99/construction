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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('total')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('details')->nullable();
            $table->string('gst')->nullable();
            $table->string('gstamount')->nullable();
            $table->string('payment_status')->nullable();
            $table->foreignId('client_id')->unsigned();
            $table->string('payment_mode')->nullable();
            $table->string('sale_no')->nullable();
            $table->string('image')->nullable();
            $table->date('date')->nullable();
            $table->foreign('client_id')->on('clients')->references('id')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

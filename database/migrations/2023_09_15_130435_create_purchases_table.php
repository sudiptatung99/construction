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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('total')->nullable();
            $table->string('subtotal')->nullable();
            $table->foreignId('vendor_id')->unsigned();
            $table->string('details')->nullable();
            $table->string('gst')->nullable();
            $table->string('gstamount')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('expeseno')->nullable();
            $table->string('image')->nullable();
            $table->foreign('vendor_id')->on('vendors')->references('id')->cascadeOnDelete();
            $table->date('date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

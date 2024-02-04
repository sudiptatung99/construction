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
        Schema::create('recive_amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->unsigned();
            $table->string('sale_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('payment_status')->nullable();
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
        Schema::dropIfExists('recive_amounts');
    }
};

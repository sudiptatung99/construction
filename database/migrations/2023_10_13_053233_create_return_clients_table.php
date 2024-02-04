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
        Schema::create('return_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->unsigned();
            $table->foreignId('sale_id')->unsigned();
            $table->date('date')->nullable();
            $table->string('total')->nullable();
            $table->foreign('client_id')->on('clients')->references('id')->cascadeOnDelete();
            $table->foreign('sale_id')->on('sales')->references('id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_clients');
    }
};

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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->unsigned();
            $table->foreignId('sale_id')->unsigned();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('amount')->nullable();
            $table->foreign('item_id')->on('items')->references('id')->cascadeOnDelete();
            $table->foreign('sale_id')->on('sales')->references('id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};

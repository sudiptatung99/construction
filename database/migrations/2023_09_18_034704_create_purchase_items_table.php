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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->unsigned();
            $table->foreignId('purchase_id')->unsigned();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('amount')->nullable();
            $table->foreign('item_id')->on('items')->references('id')->cascadeOnDelete();
            $table->foreign('purchase_id')->on('purchases')->references('id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};

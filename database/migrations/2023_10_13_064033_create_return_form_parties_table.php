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
        Schema::create('return_form_parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_client_id')->unsigned();
            $table->foreignId('item_id')->unsigned();
            $table->string('qty')->nullable();
            $table->string('amount')->nullable();
            $table->string('price')->nullable();
            $table->foreign('return_client_id')->on('return_clients')->references('id')->cascadeOnDelete();
            $table->foreign('item_id')->on('items')->references('id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_form_parties');
    }
};

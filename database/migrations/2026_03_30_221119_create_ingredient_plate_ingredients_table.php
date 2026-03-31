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
        Schema::create('plate_ingredients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('ingredient_id');
            $table->unsignedBigInteger('plate_id');
            $table->decimal('amount');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
            $table->foreign('plate_id')->references('id')->on('plates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_plate_ingredients');
    }
};

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
        Schema::create('menu_plates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('plate_id');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->boolean('is_available')->default(true);
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('plate_id')->references('id')->on('plates');
            $table->foreign('discount_id')->references('id')->on('discounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_plates');
    }
};

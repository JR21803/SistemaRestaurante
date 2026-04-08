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

            // relaciones seguras con eliminación en cascada para mantener la integridad referencial
            $table->foreign('menu_id')
                  ->references('id')
                  ->on('menus')
                  ->onDelete('cascade');

            $table->foreign('plate_id')
                  ->references('id')
                  ->on('plates')
                  ->onDelete('cascade');

            $table->foreign('discount_id')
                  ->references('id')
                  ->on('discounts')
                  ->onDelete('set null');

            // evita platos duplicados
            $table->unique(['menu_id', 'plate_id']);
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
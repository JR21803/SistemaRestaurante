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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->text('description');

            //tipo de descuento
            $table->enum('type', ['percentage', 'fixed']);

            //valores
            $table->decimal('percent', 5, 2)->nullable(); // ej: 10%
            $table->decimal('amount', 10, 2)->nullable(); // ej: $5

            //condiciones
            $table->decimal('min_total', 10, 2)->nullable(); // ej: mínimo $25

            //fechas especiales
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            //estado
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
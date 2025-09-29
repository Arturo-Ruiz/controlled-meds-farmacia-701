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
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('medicament_id')->constrained('medicaments')->onDelete('restrict');
            $table->integer('amount');
            $table->enum('reason', ['Venta', 'Medicamento Vencido', 'Error de Inventario']);
            $table->integer('current_stock');
            $table->integer('final_stock');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};

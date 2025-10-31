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
        Schema::table('medicaments', function (Blueprint $table) {
            $table->foreignId('laboratory_id')->nullable()
                ->constrained('laboratories')->onDelete('restrict');
            $table->foreignId('medicament_type_id')->nullable()
                ->constrained('medicament_types')->onDelete('restrict');
            $table->foreignId('active_ingredient_id')->nullable()
                ->constrained('active_ingredients')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicaments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('laboratory_id');
            $table->dropConstrainedForeignId('medicament_type_id');
            $table->dropConstrainedForeignId('active_ingredient_id');
        });
    }
};

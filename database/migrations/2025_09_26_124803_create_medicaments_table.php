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
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('presentation');
            $table->integer('posological_units');
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(0);
            $table->decimal('price', 10, 2);
            $table->date('expiration_date');

            $table->timestamps();

            $table->index(['name', 'presentation']);
            $table->index('expiration_date');
            $table->index('stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicaments');
    }
};

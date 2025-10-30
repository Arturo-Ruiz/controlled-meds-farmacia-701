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
        Schema::table('entries', function (Blueprint $table) {
            $table->foreignId('laboratory_id')->nullable()->change();

            $table->foreignId('drugstore_id')->nullable()->after('laboratory_id')
                ->constrained('drugstores')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entries', function (Blueprint $table) {
            $table->dropConstrainedForeignId('drugstore_id');

            $table->foreignId('laboratory_id')->nullable(false)->change();
        });
    }
};

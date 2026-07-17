<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropForeign(['antibiotic_id']);
            $table->renameColumn(
                'antibiotic_id',
                'medicine_catalog_id'
            );
            $table->foreign('medicine_catalog_id')
                ->references('id')
                ->on('medicine_catalogs')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropForeign(['medicine_catalog_id']);
            $table->renameColumn(
                'medicine_catalog_id',
                'antibiotic_id'
            );
            $table->foreign('antibiotic_id')
                ->references('id')
                ->on('antibiotics')
                ->cascadeOnDelete();
        });
    }
};

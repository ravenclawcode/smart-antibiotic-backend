<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->string('name', 100)->after('medicine_catalog_id');

            $table->unsignedBigInteger('medicine_catalog_id')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn('name');

            $table->unsignedBigInteger('medicine_catalog_id')
                ->nullable(false)
                ->change();
        });
    }
};

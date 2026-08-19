<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicine_histories', function (Blueprint $table) {
            $table->string('medicine_name', 100)->nullable()->after('schedule_time_id');
            $table->string('dosage', 255)->nullable()->after('medicine_name');
            $table->string('dosage_unit', 50)->nullable()->after('dosage');
        });
    }

    public function down(): void
    {
        Schema::table('medicine_histories', function (Blueprint $table) {
            $table->dropColumn([
                'medicine_name',
                'dosage',
                'dosage_unit',
            ]);
        });
    }
};

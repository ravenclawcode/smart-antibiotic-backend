<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicine_histories', function (Blueprint $table) {

            $table->unique([
                'schedule_time_id',
                'scheduled_date'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('medicine_histories', function (Blueprint $table) {

            $table->dropUnique([
                'schedule_time_id',
                'scheduled_date'
            ]);
        });
    }
};

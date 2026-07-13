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
        Schema::create('schedule_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')
                ->constrained('medicine_schedules')
                ->cascadeOnDelete();
            /**
             * 0 Minggu
             * 1 Senin
             * ...
             * 6 Sabtu
             */
            $table->integer('day_of_week');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_days');
    }
};

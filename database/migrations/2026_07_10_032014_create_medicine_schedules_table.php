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
        Schema::create('medicine_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')
                ->constrained()
                ->cascadeOnDelete();
            // daily, weekly, monthly, interval
            $table->string('frequency_type');
            // 2x sehari
            $table->integer('times_per_day')->default(1);
            // setiap X
            $table->integer('interval_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_schedules');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicine_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('frequency_type');
            $table->integer('times_per_day')->default(1);
            $table->integer('interval_value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicine_schedules');
    }
};

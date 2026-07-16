<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedule_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')
                ->constrained('medicine_schedules')
                ->cascadeOnDelete();
            $table->string('value');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_days');
    }
};

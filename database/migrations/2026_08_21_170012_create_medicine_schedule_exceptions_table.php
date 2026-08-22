<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicine_schedule_exceptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')
                ->constrained('medicines')
                ->cascadeOnDelete();
            $table->foreignId('schedule_time_id')
                ->constrained('schedule_times')
                ->cascadeOnDelete();
            $table->date('scheduled_date');
            $table->string('action');
            $table->decimal('dosage', 10, 2)->nullable();
            $table->string('dosage_unit', 50)->nullable();
            $table->string('instruction')->nullable();
            $table->time('reminder_time')->nullable();
            $table->timestamps();
            $table->unique(
                ['schedule_time_id', 'scheduled_date'],
                'schedule_time_date_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'medicine_schedule_exceptions'
        );
    }
};

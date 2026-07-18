<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicine_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_time_id')
                ->constrained('schedule_times')
                ->cascadeOnDelete();
            $table->date('scheduled_date');
            $table->enum('status', [
                'taken',
                'skipped',
                'missed',
                'rescheduled'
            ]);
            $table->timestamp('taken_at')->nullable();
            $table->text('notes')->nullable();
            $table->time('rescheduled_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicine_histories');
    }
};

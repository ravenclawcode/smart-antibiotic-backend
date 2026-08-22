<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicine_schedule_exceptions', function (Blueprint $table) {
            $table->string('dosage', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('medicine_schedule_exceptions', function (Blueprint $table) {
            $table->decimal('dosage', 10, 2)->nullable()->change();
        });
    }
};

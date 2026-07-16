<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antibiotics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antibiotic_category_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('summary')->nullable();
            $table->longText('indication')->nullable();
            $table->longText('mechanism')->nullable();
            $table->longText('dosage')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antibiotics');
    }
};

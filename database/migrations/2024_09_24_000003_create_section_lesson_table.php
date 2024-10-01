<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_lesson', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['section_id', 'lesson_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_lesson');
    }
};
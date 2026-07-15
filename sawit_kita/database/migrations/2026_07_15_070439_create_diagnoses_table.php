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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('disease_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('age_category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('image_path')->nullable();
            $table->decimal('confidence', 5, 2)->nullable();
            $table->enum('method', ['AI', 'Expert System']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};

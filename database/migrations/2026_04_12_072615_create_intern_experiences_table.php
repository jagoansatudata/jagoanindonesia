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
        Schema::create('intern_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('intern_name');
            $table->string('intern_role')->nullable();
            $table->text('experience_content');
            $table->integer('rating')->default(5);
            $table->string('avatar_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_experiences');
    }
};

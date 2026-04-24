<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->index();
            $table->string('path', 255)->index();
            $table->nullableMorphs('viewable');
            $table->string('ip_address', 45)->nullable()->index();
            $table->string('user_agent', 500)->nullable();
            $table->string('session_id', 100)->nullable()->index();
            $table->timestamps();

            $table->index(['created_at', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};

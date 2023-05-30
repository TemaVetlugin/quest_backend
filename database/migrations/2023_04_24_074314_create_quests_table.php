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
        Schema::create('quests', function (Blueprint $table) {
            $table->id();
            $table->string('title_start')->nullable();
            $table->string('text_start')->nullable();
            $table->string('file_start')->nullable();
            $table->string('title');
            $table->string('time')->nullable();
            $table->string('path')->nullable();
            $table->string('text')->nullable();
            $table->string('file_main')->nullable();
            $table->string('title_end')->nullable();
            $table->string('text_end')->nullable();
            $table->string('file_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quests');
    }
};

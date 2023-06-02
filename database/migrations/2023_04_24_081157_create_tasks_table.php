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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quest_id');
            $table->string('address')->nullable();
            $table->string('time')->nullable();
            $table->string('title')->nullable();
            $table->string('text')->nullable();
            $table->string('file')->nullable();
            $table->string('hint1')->nullable();
            $table->string('hint2')->nullable();
            $table->string('hint3')->nullable();
            $table->timestamps();

            $table->index('quest_id', 'task_quest_idx');
            $table->foreign('quest_id','task_quest_idx')->on('quests')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

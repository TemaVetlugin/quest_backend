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
        Schema::create('user_quests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('quest_id');

            $table->index('user_id', 'user_quest_user_idx');
            $table->foreign('user_id','user_quest_user_idx')->on('users')->references('id');

            $table->index('quest_id', 'user_quest_quest_idx');
            $table->foreign('quest_id','user_quest_quest_idx')->on('quests')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_quests');
    }
};

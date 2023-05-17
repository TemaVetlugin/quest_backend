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
        Schema::create('team_quests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('quest_id');

            $table->index('team_id', 'team_quest_team_idx');
            $table->foreign('team_id','team_quest_team_idx')->on('teams')->references('id');

            $table->index('quest_id', 'team_quest_quest_idx');
            $table->foreign('quest_id','team_quest_quest_idx')->on('quests')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_quests');
    }
};

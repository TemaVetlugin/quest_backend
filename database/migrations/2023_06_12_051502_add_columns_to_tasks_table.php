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
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('scores')->nullable();
            $table->string('hint1_time')->nullable();
            $table->unsignedBigInteger('hint1_scores')->nullable();
            $table->string('hint2_time')->nullable();
            $table->unsignedBigInteger('hint2_scores')->nullable();
            $table->string('hint3_time')->nullable();
            $table->unsignedBigInteger('hint3_scores')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('scores');
            $table->dropColumn('hint1_time');
            $table->dropColumn('hint1_scores');
            $table->dropColumn('hint2_time');
            $table->dropColumn('hint2_scores');
            $table->dropColumn('hint3_time');
            $table->dropColumn('hint3_scores');
        });
    }
};

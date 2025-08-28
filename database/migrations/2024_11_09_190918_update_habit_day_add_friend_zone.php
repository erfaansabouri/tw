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
        Schema::table('habit_days', function (Blueprint $table) {
            $table->text('friend_note')->nullable();
            $table->text('friend_satisfaction_percentage')->nullable();
            $table->text('friend_satisfaction_emoji')->nullable();
            $table->text('friend_followup_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('habit_days', function (Blueprint $table) {
            //
        });
    }
};

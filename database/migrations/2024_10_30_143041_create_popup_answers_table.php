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
        Schema::create('popup_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habit_id')
                  ->nullable();
            $table->unsignedBigInteger('day_id')
                  ->nullable();
            $table->unsignedBigInteger('popup_question_id')
                  ->nullable();
            $table->text('answer')
                  ->nullable();
            $table->text('friend_answer')
                  ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popup_answers');
    }
};

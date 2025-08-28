<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_type_id')->nullable();
            $table->json('question')->nullable();
            $table->timestamps();
        });

        Schema::create('day_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_id')->nullable();
            $table->unsignedBigInteger('exercise_id')->nullable();
            $table->integer('sort')->default(1);
            $table->timestamps();
        });

        Schema::create('habit_day_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habit_day_id')->nullable();
            $table->unsignedBigInteger('day_exercise_id')->nullable();
            $table->json('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('day_exercises');
        Schema::dropIfExists('habit_day_exercises');
    }
};

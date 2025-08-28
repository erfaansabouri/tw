<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('habits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('followup_type')->nullable(); // repeat | time
            $table->integer('followup_value')->nullable(); // repeat count | minutes count
            $table->timestamps();
        });

        Schema::create('habit_weeks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habit_id')->nullable();
            $table->integer('number')->default(1);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('habit_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habit_week_id')->nullable();
            $table->integer('number')->default(1);
            $table->date('date')->nullable();
            $table->text('note')->nullable();
            $table->integer('satisfaction_percentage')->nullable();
            $table->integer('followup_value')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('habits');
        Schema::dropIfExists('habit_weeks');
        Schema::dropIfExists('habit_days');
    }
};

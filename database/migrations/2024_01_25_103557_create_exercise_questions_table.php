<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('exercise_questions' , function ( Blueprint $table ) {
            $table->id();
            $table->integer('sort')
                  ->default(1);
            $table->unsignedBigInteger('day_id')
                  ->nullable();
            $table->string('type')
                  ->nullable();
            $table->text('question')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('exercise_questions');
    }
};

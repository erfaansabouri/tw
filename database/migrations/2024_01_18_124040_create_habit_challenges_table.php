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
        Schema::create('habit_challenges' , function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger('habit_id')
                  ->nullable();
            $table->string('title')
                  ->nullable();
            $table->timestamp('done_at')
                  ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('habit_challenges');
    }
};

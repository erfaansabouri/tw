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
        Schema::create('popup_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('sort')
                  ->default(1);
            $table->unsignedBigInteger('popup_group_id')
                  ->nullable();
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
     */
    public function down(): void
    {
        Schema::dropIfExists('popup_questions');
    }
};

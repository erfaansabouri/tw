<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->default(1);
            $table->string('title')->nullable();
            $table->string('phrase')->nullable();
            $table->timestamps();
        });

        Schema::create('day_lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('days');
        Schema::dropIfExists('day_lessons');
    }
};

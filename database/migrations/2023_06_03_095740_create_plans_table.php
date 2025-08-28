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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('monthly_price')->nullable();
            $table->integer('total_price')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle_1')->nullable();
            $table->string('subtitle_2')->nullable();
            $table->string('title_under_price')->nullable();
            $table->integer('days')->nullable();
            $table->boolean('is_unlimited')->default(0);
            $table->integer('sort')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('plans');
    }
};

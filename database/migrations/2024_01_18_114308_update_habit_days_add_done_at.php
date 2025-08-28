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
        Schema::table('habit_days', function (Blueprint $table) {
            $table->timestamp('done_at')->nullable();
        });

        $habitDays = \App\Models\HabitDay::query()
            ->whereNotNull('satisfaction_percentage')
            ->get();

        foreach ($habitDays as $habitDay){
            $habitDay->done_at = $habitDay->updated_at;
            $habitDay->save();
        }

        $habitDays = \App\Models\HabitDay::query()
                            ->whereNotNull('followup_value')
                            ->get();

        foreach ($habitDays as $habitDay){
            $habitDay->done_at = $habitDay->updated_at;
            $habitDay->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('habit_days', function (Blueprint $table) {
            $table->dropColumn('done_at');
        });
    }
};

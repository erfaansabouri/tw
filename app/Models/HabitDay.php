<?php

namespace App\Models;
class HabitDay extends Model
{
    protected $with = ['day'];

    protected static function booted()
    {
        static::created(function (HabitDay $habitDay) {
            self::createExercises($habitDay);
        });
    }

    public static function createExercises(HabitDay $habitDay)
    {
        $dayExercises = DayExercise::query()
            ->whereHas('day', function ($query) use ($habitDay){
                $query->where('days.number', '=', $habitDay->day->number);
            })->get();

        foreach ($dayExercises as $dayExercise){
            HabitDayExercise::query()
                ->create([
                    'habit_day_id' => $habitDay->id,
                    'day_exercise_id' => $dayExercise->id,
                ]);
        }
    }

    public function day()
    {
        return $this->belongsTo(Day::class, 'number', 'number');
    }

    public function habitWeek()
    {
        return $this->belongsTo(HabitWeek::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(DayLesson::class, Day::class, 'number', 'day_id');
    }

    public function myLessons(){
        return DayLesson::query()
            ->where('day_id', $this->number)
            ->orderBy('sort')
            ->get();
    }

    public function habitDayExercises()
    {
        return $this->hasMany(HabitDayExercise::class);
    }

    public function beautifyExercises(){
        $habitDayExercises = $this->habitDayExercises()->with(['habitDay', 'dayExercise.exercise.exerciseType'])->get();
        $result = [];
        foreach ($habitDayExercises as $habitDayExercise){
            $answer = $this->habitWeek->habit->isMine() ? $habitDayExercise->answer : $habitDayExercise->friend_answer;
            $result[] = [
                'id' => $habitDayExercise->id,
                'type' => $habitDayExercise->dayExercise->exercise->exerciseType->name,
                'question' => $habitDayExercise->dayExercise->exercise->decodedData(),
                'answer' => json_decode($answer),
                'sort' => $habitDayExercise->dayExercise->sort,
            ];

        }
        return $result;
    }
}

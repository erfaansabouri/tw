<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DayExercise;
use App\Models\Exercise;
use App\Models\ExerciseType;
use Illuminate\Http\Request;

class DayExerciseController extends Controller
{
    public function index(Request $request)
    {
        $dayExercises = DayExercise::query()->with(['day', 'exercise.exerciseType'])
            ->when($request->day_id != null, function ($q) use ($request){
                $q->where('day_id', $request->day_id);
            })
            ->orderBy('day_id');
        if ($request->search) {
            $dayExercises = $dayExercises->where(function ($q) use ($request) {
                $q->where('id', $request->search);
            });
        }
        $dayExercises = $dayExercises->paginate(100);
        return view('admin.day-exercises.index', compact('dayExercises'));
    }

    public function create(Request $request)
    {
        return view('admin.day-exercises.form');
    }

    public function edit(Request $request, $id)
    {
        $dayExercise = DayExercise::query()->findOrFail($id);
        return view('admin.day-exercises.form', compact('dayExercise'));
    }

    public function update(Request $request, $id){
        $dayExercise = DayExercise::findOrFail($id);
        $this->updateOrCreate($dayExercise, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->back();
    }

    public function updateOrCreate(DayExercise $dayExercise, Request $request){
        $request->validate([
            'day_id' => ['required'],
        ]);


        $dayExercise->day_id = $request->day_id;
        $dayExercise->save();

        $exercise = Exercise::query()->findOrFail($dayExercise->exercise_id);


        if ($dayExercise->exercise->exerciseType->name == ExerciseType::NAMES['ordered-list']){
            $request->validate([
                'title' => ['required'],
            ]);
            $exercise->question = json_encode(['title' => $request->title]);
            $exercise->save();
        }

        if ($dayExercise->exercise->exerciseType->name == ExerciseType::NAMES['textarea']){
            $request->validate([
                'title' => ['required'],
            ]);
            $exercise->question = json_encode(['title' => $request->title]);
            $exercise->save();
        }

        if ($dayExercise->exercise->exerciseType->name == ExerciseType::NAMES['fill-in-the-blank']){
            $request->validate([
                'phrase' => ['required'],
            ]);
            $exercise->question = json_encode(['phrase' => $request->phrase]);
            $exercise->save();
        }

        if ($dayExercise->exercise->exerciseType->name == ExerciseType::NAMES['checkbox-list']){
            $request->validate([
                'li_items' => ['required', 'array'],
            ]);
            $items = [];
            foreach ($request->li_items as $li_item){
                $items[] = ['li' => $li_item];
            }
            $exercise->question = json_encode($items);
            $exercise->save();
        }

    }
}

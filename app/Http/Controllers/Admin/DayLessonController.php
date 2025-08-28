<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\DayLesson;
use Illuminate\Http\Request;

class DayLessonController extends Controller
{
    public function index(Request $request)
    {
        $dayLessons = DayLesson::query()
            ->when($request->day_id != null, function ($q) use ($request){
                $q->where('day_id', $request->day_id);
            })
            ->with(['day'])
            ->orderBy('sort');
        if ($request->search) {
            $dayLessons = $dayLessons->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        $dayLessons = $dayLessons->paginate(100);
        return view('admin.day-lessons.index', compact('dayLessons'));
    }

    public function create(Request $request)
    {
        $day = Day::findOrFail($request->day_id);
        return view('admin.day-lessons.form', compact('day'));
    }

    public function edit(Request $request, $id)
    {
        $day = Day::findOrFail($request->day_id);
        $dayLesson = DayLesson::query()->findOrFail($id);
        return view('admin.day-lessons.form', compact('dayLesson', 'day'));
    }

    public function store(Request $request){
        $day = Day::findOrFail($request->day_id);
        $dayLesson = new DayLesson();
        $this->updateOrCreate($dayLesson, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ایجاد شد.', 'تبریک!');
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $dayLesson = DayLesson::findOrFail($id);
        $this->updateOrCreate($dayLesson, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->back();
    }

    public function updateOrCreate(DayLesson $dayLesson, Request $request){
        $request->validate([
            'day_id' => ['required'],
            'description' => ['required'],
            'image' => ['nullable']
        ]);
        $dayLesson->day_id = $request->day_id;
        $dayLesson->description = $request->description;
        $dayLesson->save();

        if ($request->hasFile('image')) {
            $dayLesson->addMediaFromRequest('image')->toMediaCollection('image');
        }
    }
}

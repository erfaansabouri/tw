<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index(Request $request)
    {
        $goals = Goal::query()
            ->orderBy('sort');
        if ($request->search) {
            $goals = $goals->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        $goals = $goals->paginate(100);
        return view('admin.goals.index', compact('goals'));
    }

    public function create(Request $request)
    {
        return view('admin.goals.form');
    }

    public function edit(Request $request, $id)
    {
        $goal = Goal::query()->findOrFail($id);
        return view('admin.goals.form', compact('goal'));
    }

    public function store(Request $request){
        $goal = new Goal();
        $this->updateOrCreate($goal, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ایجاد شد.', 'تبریک!');
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $goal = Goal::findOrFail($id);
        $this->updateOrCreate($goal, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->back();
    }

    public function updateOrCreate(Goal $goal, Request $request){
        $request->validate([
            'small_title' => ['required'],
            'full_title' => ['required'],
            'image' => ['nullable']
        ]);
        $goal->small_title = $request->small_title;
        $goal->full_title = $request->full_title;
        $goal->save();

        if ($request->hasFile('image')) {
            $goal->addMediaFromRequest('image')->toMediaCollection('image');
        }
    }
}

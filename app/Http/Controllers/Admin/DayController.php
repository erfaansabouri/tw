<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function index(Request $request)
    {
        $days = Day::query()->orderBy('number');
        if ($request->search) {
            $days = $days->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhere('panel_title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        $days = $days->paginate(100);
        return view('admin.days.index', compact('days'));
    }

    public function create()
    {
        return view('admin.days.form');
    }

    public function edit($id)
    {
        $day = Day::query()->findOrFail($id);
        return view('admin.days.form', compact('day'));
    }

    public function update(Request $request, $id){
        $day = Day::findOrFail($id);
        $this->updateOrCreate($day, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->route('admin.days.index');
    }

    public function updateOrCreate(Day $day, Request $request){
        $request->validate([
            'title' => ['required'],
            'phrase' => ['required'],
        ]);

        $day->title = $request->title;
        $day->phrase = $request->phrase;
        $day->save();
    }
}

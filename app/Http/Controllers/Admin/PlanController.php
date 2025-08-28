<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        $plans = Plan::query()
            ->orderBy('sort');
        if ($request->search) {
            $plans = $plans->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhere('title', 'like', '%' . $request->search . '%');
            });
        }
        $plans = $plans->paginate(100);
        return view('admin.plans.index', compact('plans'));
    }

    public function create(Request $request)
    {
        return view('admin.plans.form');
    }

    public function edit(Request $request, $id)
    {
        $plan = Plan::query()->findOrFail($id);
        return view('admin.plans.form', compact('plan'));
    }

    public function store(Request $request){
        $plan = new Plan();
        $this->updateOrCreate($plan, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ایجاد شد.', 'تبریک!');
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $plan = Plan::findOrFail($id);
        $this->updateOrCreate($plan, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->back();
    }

    public function destroy($id){
        $plan = Plan::findOrFail($id);
        $plan->delete();
        flash()->rtl(true)->addSuccess('رکورد با موفقیت حذف شد.', 'تبریک!');
        return redirect()->back();
    }

    public function updateOrCreate(Plan $plan, Request $request){
        $request->validate([
            'total_price' => ['required'],
        ]);
        $plan->title = $request->title;
        $plan->monthly_price = $request->monthly_price;
        $plan->total_price = $request->total_price;
        $plan->strikethrough_price = $request->strikethrough_price;
        $plan->subtitle_1 = $request->subtitle_1;
        $plan->subtitle_2 = $request->subtitle_2;
        $plan->title_under_price = $request->title_under_price;
        $plan->days = $request->days;
        $plan->is_unlimited = $request->is_unlimited;
        $plan->sort = $request->sort;
        $plan->save();
    }
}

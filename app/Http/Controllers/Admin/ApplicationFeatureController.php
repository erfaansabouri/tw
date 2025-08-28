<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationFeature;
use Illuminate\Http\Request;

class ApplicationFeatureController extends Controller
{
    public function index(Request $request)
    {
        $applicationFeatures = ApplicationFeature::query()->orderByDesc('id');
        if ($request->search) {
            $applicationFeatures = $applicationFeatures->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhere('panel_title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        $applicationFeatures = $applicationFeatures->paginate(100);
        return view('admin.application-features.index', compact('applicationFeatures'));
    }

    public function create()
    {
        return view('admin.application-features.form');
    }

    public function edit($id)
    {
        $applicationFeature = ApplicationFeature::query()->findOrFail($id);
        return view('admin.application-features.form', compact('applicationFeature'));
    }

    public function store(Request $request){
        $applicationFeature = new ApplicationFeature();
        $this->updateOrCreate($applicationFeature, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ایجاد شد.', 'تبریک!');
        return redirect()->route('admin.application-features.index');
    }

    public function update(Request $request, $id){
        $applicationFeature = ApplicationFeature::findOrFail($id);
        $this->updateOrCreate($applicationFeature, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->route('admin.application-features.index');
    }

    public function updateOrCreate(ApplicationFeature $applicationFeature, Request $request){
        $request->validate([
            'panel_title' => ['required'],
            'description' => ['required'],
            'image' => ['nullable', 'file']
        ]);

        $applicationFeature->panel_title = $request->panel_title;
        $applicationFeature->description = $request->description;
        $applicationFeature->save();

        if ($request->hasFile('image')){
            $applicationFeature->addMediaFromRequest('image')->toMediaCollection('image');
        }
    }
}

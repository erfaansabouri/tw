<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avatar;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function index(Request $request)
    {
        $avatars = Avatar::query()->orderByDesc('id');
        if ($request->search) {
            $avatars = $avatars->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhere('panel_title', 'like', '%' . $request->search . '%');

            });
        }
        $avatars = $avatars->paginate(100);
        return view('admin.avatars.index', compact('avatars'));
    }

    public function create()
    {
        return view('admin.avatars.form');
    }

    public function edit($id)
    {
        $avatar = Avatar::query()->findOrFail($id);
        return view('admin.avatars.form', compact('avatar'));
    }

    public function store(Request $request)
    {
        $avatar = new Avatar();
        $this->updateOrCreate($avatar, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ایجاد شد.', 'تبریک!');
        return redirect()->route('admin.avatars.index');
    }

    public function update(Request $request, $id)
    {
        $avatar = Avatar::findOrFail($id);
        $this->updateOrCreate($avatar, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->route('admin.avatars.index');
    }

    public function updateOrCreate(Avatar $avatar, Request $request)
    {
        $request->validate([
            'panel_title' => ['required'],
            'image' => ['nullable', 'file']
        ]);
        $avatar->panel_title = $request->panel_title;
        $avatar->save();
        if ($request->hasFile('image')) {
            $avatar->addMediaFromRequest('image')->toMediaCollection('image');
        }
    }
}

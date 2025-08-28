<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admins = Admin::query()->orderByDesc('id');

        if ($request->search) {
            $admins = $admins->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $admins = $admins->paginate(100);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:admins'],
            'password' => ['required', 'min:8'],
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();
        flash()->rtl(true)->addSuccess('ادمین با موفقیت ایجاد شد.', 'تبریک!');
        return redirect()->route('admin.admins.index');
    }

    public function edit($id)
    {
        $admin = Admin::query()->findOrFail($id);
        return view('admin.admins.form', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::query()->findOrFail($id);
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:admins,email,' . $id],
            'password' => ['nullable', 'min:8'],
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->has('password'))
            $admin->password = bcrypt($request->password);
        $admin->save();
        flash()->rtl(true)->addSuccess('ادمین با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->route('admin.admins.index');
    }

    public function destroy($id)
    {
        $admin = Admin::query()->findOrFail($id);
        $admin->delete();
        flash()->rtl(true)->addSuccess('ادمین با موفقیت حذف شد.', 'تبریک!');
        return redirect()->route('admin.admins.index');
    }
}

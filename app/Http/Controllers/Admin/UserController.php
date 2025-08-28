<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->orderByDesc('id');
        if ($request->search) {
            $users = $users->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }
        $users = $users->paginate(100);
        return view('admin.users.index', compact('users'));
    }

    public function show(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function create(Request $request)
    {
        return view('admin.users.form');
    }

    public function edit(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);
        return view('admin.users.form', compact('user'));
    }

    public function store(Request $request){
        $request->validate([
                               'phone' => ['required', 'unique:users,phone'],
                           ]);
        $phone = Helper::standardPhone($request->phone);
        if (User::where('phone', $phone)->exists()){
            flash()->rtl(true)->addError('شماره تکراری است.', 'خطا!');
            return redirect()->back();
        }
        $user = new User();
        $user->premium_expired_at = now();
        $user->register_completed_at = now();
        $this->updateOrCreate($user, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ایجاد شد.', 'تبریک!');
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $request->validate([
                               'phone' => ['required', 'unique:users,phone,' . $id],
                           ]);
        $user = User::findOrFail($id);
        $phone = Helper::standardPhone($request->phone);
        if (User::where('phone', $phone)->where('id', '!=', $user->id)->exists()){
            flash()->rtl(true)->addError('شماره تکراری است.', 'خطا!');
            return redirect()->back();
        }
        $this->updateOrCreate($user, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->back();
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        flash()->rtl(true)->addSuccess('رکورد با موفقیت حذف شد.', 'تبریک!');
        return redirect()->back();
    }

    public function updateOrCreate(User $user, Request $request){
        $request->validate([
            'name' => ['required'],
            'goal_ids' => ['required'],
        ]);
        $user->name = $request->name;
        $user->phone = Helper::standardPhone($request->phone);;
        $user->goals()->sync($request->goal_ids);
        if ($request->gift_plan_id){
            $user->addCredit(Plan::findOrFail($request->gift_plan_id));
        }
        if ($request->premium_days){
            if ($request->premium_days == 'zero'){
                $user->premium_expired_at = now();
            }
            elseif ($request->premium_days == 'unlimited'){
                $user->premium_expired_at = null;
            }
            else{
                $user->premium_expired_at = now()->addDays($request->premium_days);
            }
        }
        $user->save();
    }
}

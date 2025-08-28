<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function index(Request $request)
    {
        $instructions = Instruction::query()
            ->orderBy('sort');
        if ($request->search) {
            $instructions = $instructions->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        $instructions = $instructions->paginate(100);
        return view('admin.instructions.index', compact('instructions'));
    }

    public function create(Request $request)
    {
        return view('admin.instructions.form');
    }

    public function edit(Request $request, $id)
    {
        $instruction = Instruction::query()->findOrFail($id);
        return view('admin.instructions.form', compact('instruction'));
    }

    public function store(Request $request){
        $instruction = new Instruction();
        $this->updateOrCreate($instruction, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ایجاد شد.', 'تبریک!');
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $instruction = Instruction::findOrFail($id);
        $this->updateOrCreate($instruction, $request);
        flash()->rtl(true)->addSuccess('رکورد با موفقیت ویرایش شد.', 'تبریک!');
        return redirect()->back();
    }

    public function updateOrCreate(Instruction $instruction, Request $request){
        $request->validate([
            'description' => ['required'],
        ]);
        $instruction->description = $request->description;
        $instruction->save();
    }
}

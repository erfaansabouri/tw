<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApplicationFeatureController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AvatarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\DayExerciseController;
use App\Http\Controllers\Admin\DayLessonController;
use App\Http\Controllers\Admin\GoalController;
use App\Http\Controllers\Admin\InstructionController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;



Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.auth.login-form');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
});
Route::middleware(['auth:admin'])->group(function () {
    // dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'show'])->name('admin.dashboard.show');
    });

    // admins
    Route::prefix('admins')->middleware([])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.admins.index');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.admins.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.admins.store');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.admins.edit');
        Route::put('/update/{id}', [AdminController::class, 'update'])->name('admin.admins.update');
        Route::get('/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');
    });

    // application features
    Route::prefix('application-features')->middleware([])->group(function () {
        Route::get('/', [ApplicationFeatureController::class, 'index'])->name('admin.application-features.index');
        Route::get('/create', [ApplicationFeatureController::class, 'create'])->name('admin.application-features.create');
        Route::post('/store', [ApplicationFeatureController::class, 'store'])->name('admin.application-features.store');
        Route::get('/edit/{id}', [ApplicationFeatureController::class, 'edit'])->name('admin.application-features.edit');
        Route::put('/update/{id}', [ApplicationFeatureController::class, 'update'])->name('admin.application-features.update');
        Route::get('/destroy/{id}', [ApplicationFeatureController::class, 'destroy'])->name('admin.application-features.destroy');
    });

    // avatars
    Route::prefix('avatars')->middleware([])->group(function () {
        Route::get('/', [AvatarController::class, 'index'])->name('admin.avatars.index');
        Route::get('/create', [AvatarController::class, 'create'])->name('admin.avatars.create');
        Route::post('/store', [AvatarController::class, 'store'])->name('admin.avatars.store');
        Route::get('/edit/{id}', [AvatarController::class, 'edit'])->name('admin.avatars.edit');
        Route::put('/update/{id}', [AvatarController::class, 'update'])->name('admin.avatars.update');
        Route::get('/destroy/{id}', [AvatarController::class, 'destroy'])->name('admin.avatars.destroy');
    });

    // days
    Route::prefix('days')->middleware([])->group(function () {
        Route::get('/', [DayController::class, 'index'])->name('admin.days.index');
        Route::get('/create', [DayController::class, 'create'])->name('admin.days.create');
        Route::post('/store', [DayController::class, 'store'])->name('admin.days.store');
        Route::get('/edit/{id}', [DayController::class, 'edit'])->name('admin.days.edit');
        Route::put('/update/{id}', [DayController::class, 'update'])->name('admin.days.update');
        Route::get('/destroy/{id}', [DayController::class, 'destroy'])->name('admin.days.destroy');
    });

    // day lessons
    Route::prefix('day-lessons')->middleware([])->group(function () {
        Route::get('/', [DayLessonController::class, 'index'])->name('admin.day-lessons.index');
        Route::get('/create', [DayLessonController::class, 'create'])->name('admin.day-lessons.create');
        Route::post('/store', [DayLessonController::class, 'store'])->name('admin.day-lessons.store');
        Route::get('/edit/{id}', [DayLessonController::class, 'edit'])->name('admin.day-lessons.edit');
        Route::put('/update/{id}', [DayLessonController::class, 'update'])->name('admin.day-lessons.update');
        Route::get('/destroy/{id}', [DayLessonController::class, 'destroy'])->name('admin.day-lessons.destroy');
    });

    // day exercises
    Route::prefix('day-exercises')->middleware([])->group(function () {
        Route::get('/', [DayExerciseController::class, 'index'])->name('admin.day-exercises.index');
        Route::get('/create', [DayExerciseController::class, 'create'])->name('admin.day-exercises.create');
        Route::post('/store', [DayExerciseController::class, 'store'])->name('admin.day-exercises.store');
        Route::get('/edit/{id}', [DayExerciseController::class, 'edit'])->name('admin.day-exercises.edit');
        Route::put('/update/{id}', [DayExerciseController::class, 'update'])->name('admin.day-exercises.update');
        Route::get('/destroy/{id}', [DayExerciseController::class, 'destroy'])->name('admin.day-exercises.destroy');
    });

    // goals
    Route::prefix('goals')->middleware([])->group(function () {
        Route::get('/', [GoalController::class, 'index'])->name('admin.goals.index');
        Route::get('/create', [GoalController::class, 'create'])->name('admin.goals.create');
        Route::post('/store', [GoalController::class, 'store'])->name('admin.goals.store');
        Route::get('/edit/{id}', [GoalController::class, 'edit'])->name('admin.goals.edit');
        Route::put('/update/{id}', [GoalController::class, 'update'])->name('admin.goals.update');
        Route::get('/destroy/{id}', [GoalController::class, 'destroy'])->name('admin.goals.destroy');
    });

    // instructions
    Route::prefix('instructions')->middleware([])->group(function () {
        Route::get('/', [InstructionController::class, 'index'])->name('admin.instructions.index');
        Route::get('/create', [InstructionController::class, 'create'])->name('admin.instructions.create');
        Route::post('/store', [InstructionController::class, 'store'])->name('admin.instructions.store');
        Route::get('/edit/{id}', [InstructionController::class, 'edit'])->name('admin.instructions.edit');
        Route::put('/update/{id}', [InstructionController::class, 'update'])->name('admin.instructions.update');
        Route::get('/destroy/{id}', [InstructionController::class, 'destroy'])->name('admin.instructions.destroy');
    });

    // plans
    Route::prefix('plans')->middleware([])->group(function () {
        Route::get('/', [PlanController::class, 'index'])->name('admin.plans.index');
        Route::get('/create', [PlanController::class, 'create'])->name('admin.plans.create');
        Route::post('/store', [PlanController::class, 'store'])->name('admin.plans.store');
        Route::get('/edit/{id}', [PlanController::class, 'edit'])->name('admin.plans.edit');
        Route::put('/update/{id}', [PlanController::class, 'update'])->name('admin.plans.update');
        Route::get('/destroy/{id}', [PlanController::class, 'destroy'])->name('admin.plans.destroy');
    });

    // plans
    Route::prefix('users')->middleware([])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('admin.users.show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // plans
    Route::prefix('transactions')->middleware([])->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('admin.transactions.index');
        Route::get('/create', [TransactionController::class, 'create'])->name('admin.transactions.create');
        Route::post('/store', [TransactionController::class, 'store'])->name('admin.transactions.store');
        Route::get('/edit/{id}', [TransactionController::class, 'edit'])->name('admin.transactions.edit');
        Route::put('/update/{id}', [TransactionController::class, 'update'])->name('admin.transactions.update');
        Route::get('/destroy/{id}', [TransactionController::class, 'destroy'])->name('admin.transactions.destroy');
    });
});

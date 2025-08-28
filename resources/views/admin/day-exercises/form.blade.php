@extends('admin.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($dayExercise))
                            ویرایش اطلاعات تمرین {{ $dayExercise->day->title }} ({{ $dayExercise->sort }})
                        @else
                            ایجاد تمرین جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post" action="@if(isset($dayExercise)){{ route('admin.day-exercises.update', $dayExercise->id) }}@else{{ route('admin.day-exercises.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($dayExercise))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="card-body ">
                        <div class="form-group">
                            <label class="col-form-label">روز<span class="text-danger">*</span></label>
                            <select class="form-control" name="day_id">
                                @foreach(\App\Models\Day::all() as $day)
                                    <option @if(isset($dayExercise) && $dayExercise->day_id == $day->id) selected @endif value="{{ $day->id }}">{{ $day->title }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">روز را وارد کنید.</small>
                        </div>
                        @if($dayExercise->exercise->exerciseType->name == \App\Models\ExerciseType::NAMES['ordered-list'] || $dayExercise->exercise->exerciseType->name == \App\Models\ExerciseType::NAMES['textarea'])
                            @include('admin.day-exercises.title-input', ['dayExercise' => $dayExercise])
                        @endif
                        @if($dayExercise->exercise->exerciseType->name == \App\Models\ExerciseType::NAMES['fill-in-the-blank'])
                            @include('admin.day-exercises.fill-in-the-blank-input', ['dayExercise' => $dayExercise])
                        @endif
                        @if($dayExercise->exercise->exerciseType->name == \App\Models\ExerciseType::NAMES['checkbox-list'])
                            @include('admin.day-exercises.checkboxes-input', ['dayExercise' => $dayExercise])
                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.day-lessons.index') }}" class="btn btn-secondary">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
@endpush

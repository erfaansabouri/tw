@extends('admin.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($day))
                            ویرایش اطلاعات {{ $day->title }}
                        @else
                            ایجاد روز جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post" action="@if(isset($day)){{ route('admin.days.update', $day->id) }}@else{{ route('admin.days.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($day))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="card-body ">
                        <div class="form-group">
                            <label class="col-form-label">عنوان<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="title" class="form-control"
                                   placeholder="عنوان را وارد کنید."
                                   value="@if(isset($day)){{ $day->title }}@else{{ old('title') }}@endif"/>
                            <small class="form-text text-muted">عنوان را وارد کنید.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phrase">متن<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="phrase" id="phrase" rows="4">@if(isset($day)){{ $day->phrase }}@else{{ old('phrase') }}@endif</textarea>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.days.index') }}" class="btn btn-secondary">بازگشت</a>
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

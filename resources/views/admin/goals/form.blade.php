@extends('admin.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($goal))
                            ویرایش اطلاعات {{ $goal->title }}
                        @else
                            ایجاد هدف جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post" action="@if(isset($goal)){{ route('admin.goals.update', $goal->id) }}@else{{ route('admin.goals.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($goal))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="card-body ">
                        <div class="form-group">
                            <label class="col-form-label">ترتیب<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="number" name="sort" class="form-control"
                                   placeholder="ترتیب را وارد کنید."
                                   value="@if(isset($goal)){{ $goal->sort }}@else{{ old('sort') }}@endif"/>
                            <small class="form-text text-muted">ترتیب را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">عنوان کوتاه<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="small_title" class="form-control"
                                   placeholder="عنوان کوتاه را وارد کنید."
                                   value="@if(isset($goal)){{ $goal->small_title }}@else{{ old('small_title') }}@endif"/>
                            <small class="form-text text-muted">عنوان کوتاه را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">عنوان کامل<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="full_title" class="form-control"
                                   placeholder="عنوان کامل را وارد کنید."
                                   value="@if(isset($goal)){{ $goal->full_title }}@else{{ old('full_title') }}@endif"/>
                            <small class="form-text text-muted">عنوان کامل را وارد کنید.</small>
                        </div>
                        <div class="form-group mt-3">
                            <div class="row">
                                <label class="col-form-label col-1">تصویر<span class="text-danger">*</span></label>
                                <div class="image-input image-input-outline" id="kt_image_1">
                                    <div class="image-input-wrapper"
                                         style="background-image: url(@if(isset($goal) && $goal->getFirstMediaUrl('image')) {{ $goal->getFirstMediaUrl('image') }} @else {{ asset('admin-assets/media/no-image-user.png') }} @endif)"></div>

                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="تغییر تصویر">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                    </label>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                          data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
  <i class="ki ki-bold-close icon-xs text-muted"></i>
 </span>
                                </div>
                            </div>
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

@extends('admin.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($applicationFeature))
                            ویرایش اطلاعات {{ $applicationFeature->name }}
                        @else
                            ایجاد ادمین جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post" action="@if(isset($applicationFeature)){{ route('admin.application-features.update', $applicationFeature->id) }}@else{{ route('admin.application-features.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($applicationFeature))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="card-body ">
                        <div class="form-group">
                            <label class="col-form-label">عنوان نمایشی پنل مدیریت<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="panel_title" class="form-control"
                                   placeholder="عنوان نمایشی پنل مدیریت را وارد کنید."
                                   value="@if(isset($applicationFeature)){{ $applicationFeature->panel_title }}@else{{ old('panel_title') }}@endif"/>
                            <small class="form-text text-muted">فقط در پنل قابل مشاهده است..</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">متن<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" id="description" rows="4">@if(isset($applicationFeature)){{ $applicationFeature->description }}@else{{ old('description') }}@endif</textarea>
                        </div>

                        <div class="form-group mt-3">
                            <div class="row">
                                <label class="col-form-label col-1">تصویر<span class="text-danger">*</span></label>
                                <div class="image-input image-input-outline" id="kt_image_1">
                                    <div class="image-input-wrapper"
                                         style="background-image: url(@if(isset($applicationFeature) && $applicationFeature->getFirstMediaUrl('image')) {{ $applicationFeature->getFirstMediaUrl('image') }} @else {{ asset('admin-assets/media/no-image-user.png') }} @endif)"></div>

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
                        <a href="{{ route('admin.application-features.index') }}" class="btn btn-secondary">بازگشت</a>
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

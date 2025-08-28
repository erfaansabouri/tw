@extends('admin.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($plan))
                            ویرایش اطلاعات {{ $plan->title }}
                        @else
                            ایجاد اشتراک جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post" action="@if(isset($plan)){{ route('admin.plans.update', $plan->id) }}@else{{ route('admin.plans.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($plan))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="card-body ">
                        <div class="form-group">
                            <label class="col-form-label">عنوان<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="title" class="form-control"
                                   placeholder="عنوان را وارد کنید."
                                   value="@if(isset($plan)){{ $plan->title }}@else{{ old('title') }}@endif"/>
                            <small class="form-text text-muted">عنوان را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">قیمت ماهانه به تومان<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="monthly_price" class="form-control"
                                   placeholder="قیمت ماهانه به تومان را وارد کنید."
                                   value="@if(isset($plan)){{ $plan->monthly_price }}@else{{ old('monthly_price') }}@endif"/>
                            <small class="form-text text-muted">قیمت ماهانه به تومان را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">قیمت کل به تومان<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="total_price" class="form-control"
                                   placeholder="قیمت کل به تومان را وارد کنید."
                                   value="@if(isset($plan)){{ $plan->total_price }}@else{{ old('total_price') }}@endif"/>
                            <small class="form-text text-muted">قیمت کل به تومان را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">قیمت خط خورده به تومان<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="strikethrough_price" class="form-control"
                                   placeholder="قیمت خط خورده به تومان را وارد کنید."
                                   value="@if(isset($plan)){{ $plan->strikethrough_price }}@else{{ old('strikethrough_price') }}@endif"/>
                            <small class="form-text text-muted">قیمت خط خورده به تومان را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">زیر عنوان یک<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="subtitle_1" class="form-control"
                                   placeholder="زیر عنوان یک را وارد کنید."
                                   value="@if(isset($plan)){{ $plan->subtitle_1 }}@else{{ old('subtitle_1') }}@endif"/>
                            <small class="form-text text-muted">زیر عنوان یک را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">زیر عنوان دو<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="subtitle_2" class="form-control"
                                   placeholder="زیر عنوان دو را وارد کنید."
                                   value="@if(isset($plan)){{ $plan->subtitle_2 }}@else{{ old('subtitle_2') }}@endif"/>
                            <small class="form-text text-muted">زیر عنوان دو را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">عنوان زیر قیمت<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="title_under_price" class="form-control"
                                   placeholder="عنوان زیر قیمت را وارد کنید."
                                   value="@if(isset($plan)){{ $plan->title_under_price }}@else{{ old('title_under_price') }}@endif"/>
                            <small class="form-text text-muted">عنوان زیر قیمت را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">تعداد روز های اشتراک<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="days" class="form-control"
                                   placeholder="تعداد روز های اشتراک را وارد کنید."
                                   value="@if(isset($plan)){{ $plan->days }}@else{{ old('days') }}@endif"/>
                            <small class="form-text text-muted">تعداد روز های اشتراک را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">آیا اشتراک نامحدود است؟<span class="text-danger">*</span></label>
                            <select class="form-control" name="is_unlimited">
                                <option @if(isset($plan) && !$plan->is_unlimited) selected @endif value="0">خیر</option>
                                <option @if(isset($plan) && $plan->is_unlimited) selected @endif value="1">بله</option>
                            </select>
                            <small class="form-text text-muted">آیا اشتراک نامحدود است؟ را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">ترتیب نمایش<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="number" name="sort" class="form-control"
                                   placeholder="ترتیب را وارد کنید."
                                   value="@if(isset($plan)){{ $plan->sort }}@else{{ old('sort') }}@endif"/>
                            <small class="form-text text-muted">ترتیب را وارد کنید.</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">بازگشت</a>
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

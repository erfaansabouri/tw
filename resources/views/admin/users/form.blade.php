@extends('admin.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($user))
                            اطلاعات {{ $user->name }}
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post" action="@if(isset($user)){{ route('admin.users.update', $user->id) }}@else{{ route('admin.users.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="card-body ">
                        <div class="form-group">
                            <label class="col-form-label">نام<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="name" class="form-control"
                                   placeholder="نام را وارد کنید."
                                   value="@if(isset($user)){{ $user->name }}@else{{ old('name') }}@endif"/>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">شماره<span class="text-danger">*</span></label>
                            <input  autocomplete="off" type="text" name="phone" class="form-control"
                                   placeholder="شماره را وارد کنید."
                                   value="@if(isset($user)){{ $user->phone }}@else{{ old('phone') }}@endif"/>
                        </div>
                        @if(isset($user))
                            <div class="form-group">
                                <label class="col-form-label">وضعیت ویژه: <span class="text-danger"></span></label>
                                @if($user->is_premium)
                                    <b class="text-success"> ویژه - {{ __($user->premium_remaining_days) }} روز</b>
                                @else
                                    <b class="text-secondary">عادی</b>
                                @endif
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="col-form-label">اهداف<span class="text-danger"></span></label>
                            @foreach(\App\Models\Goal::all() as $goal)
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input @if(isset($user) && in_array($goal->id, $user->goals()->get()->pluck('id')->toArray())) checked @endif type="checkbox" name="goal_ids[]" value="{{ $goal->id }}">
                                        <span></span>
                                        {{ $goal->full_title }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="alert alert-custom alert-default" role="alert">
                            <div class="alert-icon"><span class="svg-icon svg-icon-primary svg-icon-xl"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                                            <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                                        </g>
                                    </svg><!--end::Svg Icon--></span></div>
                            <div class="alert-text">
                                لطفا تنها در صورتی که قصد تغییر در تعداد روز اشتراک این کاربر را دارید، گزینه زیر را پر کنید.
                                <br>
                                برای صفر کردن اعتبار کاربر zero را وارد کنید.
                                <br>
                                برای بی نهایت کردن اعتبار کاربر unlimited را وارد کنید.
                                <br>
                                برای اعتبار بخشیدن به اندازه روز عدد صحیح از 1 به بالا وارد کنید.
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">تغییر روز اشتراک به</label>
                            <div class="col-5">
                                <input class="form-control" name="premium_days" type="text" value="" id="premium_days">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">بازگشت</a>
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

@extends('admin.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($admin))
                            ویرایش اطلاعات {{ $admin->name }}
                        @else
                            ایجاد ادمین جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post" action="@if(isset($admin)){{ route('admin.admins.update', $admin->id) }}@else{{ route('admin.admins.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($admin))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="card-body ">
                        <div class="form-group">
                            <label class="col-form-label">نام<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="name" class="form-control"
                                   placeholder="نام را وارد کنید."
                                   value="@if(isset($admin)) {{ $admin->name }} @else {{ old('name') }} @endif"/>
                            <small class="form-text text-muted">نام را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">ایمیل<span class="text-danger">*</span></label>
                            <input autocomplete="off" name="email" class="form-control"
                                   placeholder="ایمیل را وارد کنید."
                                   value="@if(isset($admin)) {{ $admin->email }} @else {{ old('email') }} @endif"/>
                            <small class="form-text text-muted">ایمیل را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">رمز عبور<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="password" name="password" class="form-control"
                                   placeholder="رمز عبور را وارد کنید."/>
                            <small class="form-text text-muted">رمز عبور را وارد کنید.</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


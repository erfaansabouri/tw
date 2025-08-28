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
                            <input readonly disabled autocomplete="off" type="text" name="title" class="form-control"
                                   placeholder="نام را وارد کنید."
                                   value="@if(isset($user)){{ $user->name }}@else{{ old('name') }}@endif"/>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">شماره<span class="text-danger">*</span></label>
                            <input readonly disabled autocomplete="off" type="text" name="phone" class="form-control"
                                   placeholder="شماره را وارد کنید."
                                   value="@if(isset($user)){{ $user->phone }}@else{{ old('phone') }}@endif"/>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">وضعیت ویژه<span class="text-danger">*</span></label>
                            <input readonly disabled autocomplete="off" type="text" name="phone" class="form-control"
                                   placeholder="شماره را وارد کنید."
                                   value="@if(isset($user)){{ $user->is_premium ? "ویژه - {$user->premium_remaining_days} روز" : "عادی"  }}@else{{ old('phone') }}@endif"/>
                        </div>
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

@extends('admin.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($instruction))
                            ویرایش اطلاعات {{ $instruction->title }}
                        @else
                            ایجاد راهنمای جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post" action="@if(isset($instruction)){{ route('admin.instructions.update', $instruction->id) }}@else{{ route('admin.instructions.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($instruction))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="card-body ">
                        <div class="form-group">
                            <label class="col-form-label">ترتیب<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="number" name="sort" class="form-control"
                                   placeholder="ترتیب را وارد کنید."
                                   value="@if(isset($instruction)){{ $instruction->sort }}@else{{ old('sort') }}@endif"/>
                            <small class="form-text text-muted">ترتیب را وارد کنید.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">متن<span class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" name="description" class="form-control"
                                   placeholder="عنوان کوتاه را وارد کنید."
                                   value="@if(isset($instruction)){{ $instruction->description }}@else{{ old('description') }}@endif"/>
                            <small class="form-text text-muted">متن را وارد کنید.</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.instructions.index') }}" class="btn btn-secondary">بازگشت</a>
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

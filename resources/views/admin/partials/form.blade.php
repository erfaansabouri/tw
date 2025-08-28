@extends('admin.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($record))
                            ویرایش اطلاعات {{ $configs['model_title'] }} {{ $record->panel_title }}
                        @else
                            افزودن به لیست {{ $configs['model_title'] }} ها
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post" action="@if(isset($record)) {{ route($configs['table_update_route'], $record->id) }} @else {{ route($configs['table_store_route']) }} @endif" enctype="multipart/form-data">
                    @csrf
                    @if(isset($record))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    {{-- show errors if any--}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('form_body')
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route($configs['table_index_route']) }}" class="btn btn-secondary">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


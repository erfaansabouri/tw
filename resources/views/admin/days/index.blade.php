@extends('admin.master')
@section('content')
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">روز ها
                                <span class="text-muted pt-2 font-size-sm d-block"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <form action="{{ route('admin.days.index') }}" method="get">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input name="search" type="text" class="form-control"
                                                           placeholder="جستجو..." value="{{ request()->search }}"/>
                                                    <span><i class="flaticon2-search-1 text-muted"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                        <button class="btn btn-light-primary px-6 font-weight-bold">اعمال فیلتر</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{ $days->withQueryString()->links("pagination::bootstrap-4") }}

                        <table
                            class="table table-bordered table-striped table-responsive-md table-responsive-lg table-responsive-sm">
                            <caption>روز ها</caption>
                            <thead class="thead-light iransans-web">
                            <tr>
                                <th class="iransans-web">شناسه</th>
                                <th class="iransans-web">عنوان روز</th>
                                <th class="iransans-web">متن روز</th>
                                <th class="iransans-web">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($days as $day)
                                <tr>
                                    <td class="iransans-web">{{ $day->id }}</td>
                                    <td class="iransans-web">{{ $day->title }}</td>
                                    <td class="iransans-web">{{ $day->phrase }}</td>
                                    <td>
                                        <a href="{{ route('admin.day-lessons.index', ['day_id' => $day->id]) }}">
                                            <button class="btn btn-info btn-hover-white btn-sm"><span
                                                    class="fa fa-book-open"></span></button>
                                        </a>
                                        <a href="{{ route('admin.days.edit', $day->id) }}">
                                            <button class="btn btn-primary btn-hover-white btn-sm"><span
                                                    class="fa fa-edit"></span></button>
                                        </a>
                                        <a href="{{ route('admin.days.destroy', $day->id) }}">
                                            <button class="btn btn-danger btn-hover-white btn-sm"><span
                                                    class="fa fa-trash"></span></button>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    {{ $days->withQueryString()->links("pagination::bootstrap-4") }}

                    <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>

@endsection


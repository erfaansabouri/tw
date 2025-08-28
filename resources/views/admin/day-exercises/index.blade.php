@extends('admin.master')
@section('content')
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">تمرین ها
                                <span class="text-muted pt-2 font-size-sm d-block"></span>
                            </h3>
                        </div>

                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <form action="{{ route('admin.day-exercises.index') }}" method="get">
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
                        {{ $dayExercises->withQueryString()->links("pagination::bootstrap-4") }}

                        <table
                            class="table table-bordered table-striped table-responsive-md table-responsive-lg table-responsive-sm">
                            <caption>تمرین ها</caption>
                            <thead class="thead-light iransans-web">
                            <tr>
                                <th class="iransans-web">شناسه</th>
                                <th class="iransans-web">روز مربوطه</th>
                                <th class="iransans-web">نوع تمرین</th>
                                <th class="iransans-web">پیش نمایش</th>
                                <th class="iransans-web">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dayExercises as $dayExercise)
                                <tr>
                                    <td class="iransans-web">{{ $dayExercise->id }}</td>
                                    <td class="iransans-web">{{ $dayExercise->day->title }}</td>
                                    <td class="iransans-web">{{ $dayExercise->exercise->exerciseType->name_fa }}</td>
                                    <td class="iransans-web">{{ $dayExercise->exercise->preview }}</td>
                                    <td>
                                        <a href="{{ route('admin.day-exercises.edit', ['id' => $dayExercise->id, 'day_id' => request('day_id')]) }}">
                                            <button class="btn btn-primary btn-hover-white btn-sm"><span
                                                    class="fa fa-edit"></span></button>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    {{ $dayExercises->withQueryString()->links("pagination::bootstrap-4") }}

                    <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>

@endsection

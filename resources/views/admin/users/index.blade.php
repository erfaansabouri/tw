@extends('admin.master')
@section('content')
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">کاربران
                                <span class="text-muted pt-2 font-size-sm d-block"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ route('admin.users.create') }}"
                               class="btn btn-success font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"/>
														<circle fill="#000000" cx="9" cy="15" r="6"/>
														<path
                                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                            fill="#000000" opacity="0.3"/>
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>ایجاد</a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <form action="{{ route('admin.users.index') }}" method="get">
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
                        {{ $users->withQueryString()->links("pagination::bootstrap-4") }}

                        <table
                            class="table table-bordered table-striped table-responsive-md table-responsive-lg table-responsive-sm">
                            <caption>کاربران</caption>
                            <thead class="thead-light iransans-web">
                            <tr>
                                <th class="iransans-web">شناسه</th>
                                <th class="iransans-web">نام</th>
                                <th class="iransans-web">شماره</th>
                                <th class="iransans-web">وضعیت ویژه بودن</th>
                                <th class="iransans-web">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="iransans-web">{{ $user->id }}</td>
                                    <td class="iransans-web">{{ $user->name }}</td>
                                    <td class="iransans-web">{{ $user->phone }}</td>
                                    <td class="iransans-web">
                                        @if($user->is_premium)
                                            <b class="text-success"> ویژه - {{ __($user->premium_remaining_days) }} روز</b>
                                        @else
                                            <b class="text-secondary">عادی</b>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $user->id) }}">
                                            <button class="btn btn-primary btn-hover-white btn-sm"><span
                                                    class="fa fa-eye"></span></button>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}">
                                            <button class="btn btn-primary btn-hover-white btn-sm"><span
                                                    class="fa fa-pen"></span></button>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    {{ $users->withQueryString()->links("pagination::bootstrap-4") }}

                    <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>

@endsection


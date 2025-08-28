<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header header-fixed">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Topbar-->
            <div class="topbar">
                <div class="topbar-item">
                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1 iransans-web">سلام،</span>
                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3 iransans-web">{{ \Illuminate\Support\Facades\Auth::user()->name  }}</span>
                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success"></span>
                    </div>
                </div>
                <!--begin::Languages-->
                <div class="dropdown">
                    <!--begin::Toggle-->
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                            <i class="h-20px w-20px rounded-sm fa fa-user" ></i>
                        </div>
                    </div>
                    <!--end::Toggle-->
                    <!--begin::Dropdown-->
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Nav-->
                        <ul class="navi navi-hover py-4">
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="navi-item">
                                <a href="{{ route('admin.auth.logout') }}" class="navi-link">
                                    <span class="navi-text">خروج</span>
                                    <span class="symbol symbol-20 mr-3">
														<i class="fa fa-sign-out-alt"></i>
													</span>
                                </a>
                            </li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Languages-->

            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
    <!--begin::Content-->
@yield('content')
    <!--end::Content-->
    <!--begin::Footer-->
{{--
    <div class="footer bg-white py-4 d-flex flex-lg-column fixed-bottom" id="kt_footer">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <a href="{{ env('APP_URL') }}" target="_blank" class="text-dark-75 text-hover-primary">
                    {{ env('APP_NAME_FA') }} - ورژن 2.1
                </a>
            </div>
            <!--end::Copyright-->
            <!--begin::Nav-->
            <div class="nav nav-dark">

            </div>
            <!--end::Nav-->
        </div>
        <!--end::Container-->
    </div>
--}}
    <!--end::Footer-->
</div>

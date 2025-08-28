<!DOCTYPE html>
<html lang="en" dir="rtl" style="direction: rtl">
<head>
    <meta charset="utf-8"/>
    <title>{{ env('APP_NAME_FA') }} | ورود مدیریت </title>
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('admin-assets/media/fav.ico') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="{{ asset('admin-assets/css/pages/login/classic/login-5.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin-assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin-assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin-assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin-assets/css/custom_style.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<div class="d-flex flex-column flex-root">
    <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
             style="background-image: url({{ asset('admin-assets/media/bg.webp') }});">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <div class="d-flex flex-center mb-15">
                    <a target="_blank" href="{{ env('APP_URL') }}">
                        <img style="" src="{{ asset('admin-assets/media/21icon.png') }}" class="max-h-75px" alt="وبسایت"/>
                    </a>
                </div>
                <div class="login-signin">
                    <div class="mb-20">
                        <h3 class="">ورود به مدیریت</h3>
                        <p class="">لطفا اطلاعات کاربری خود را وارد نمایید:</p>
                    </div>
                    <form method="post" action="{{ route('admin.auth.login') }}" class="form" id="kt_login_signin_form">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                   type="text" placeholder="ایمیل" name="email" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                   type="password" placeholder="رمز عبور" name="password"/>
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8"></div>
                        <div class="form-group text-center mt-10">
                            <button id="kt_login_signin_submit" class="btn btn-pill btn-primary btn-block px-15 py-3">
                                ورود
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };</script>
<script src="{{ asset('admin-assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('admin-assets/js/scripts.bundle.js') }}"></script>
@include('admin.partials.toastr')
</body>
</html>

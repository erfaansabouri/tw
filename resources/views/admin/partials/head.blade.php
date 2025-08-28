<head>
    <base href="">
    <meta charset="utf-8" />
    <title>مدیریت 21 روز {{ env('APP_NAME_FA') }} @yield('title')</title>
    <meta name="description" content="{{ env('APP_NAME') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="{{ asset('admin-assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('global-assets/css/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

    {{--fav ico--}}
    <link rel="shortcut icon" href="{{ asset('landing-assets/img/favicon.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/custom_style.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('gameato-assets/js/jquery.js') }}"></script>

    @stack('head')

</head>

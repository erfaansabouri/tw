<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>21 روز</title>

    <link rel="stylesheet" href="{{ asset('landing-assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing-assets/css/main.css') }}" />

    <link rel="icon" href="{{ asset('landing-assets/img/favicon.png') }}" />
</head>
<body>
<section class="mainSec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="#" class="logoBox">
                    <img src="{{ asset('landing-assets/img/logo.png') }}" alt="logo" />
                </a>
                <div class="mainSecBox">
                    <div class="mainSecRght">
                        <h1>یک اپ برای ساختن هر عادتی</h1>
                        <ul class="mainItems">
                            <li>
                                <span></span>
                                <p>
                                    اینجا قراره عادت هایی رو بسازی که نگرانی و اضطراب رو ازت
                                    دور می‌کنن.
                                </p>
                            </li>
                            <li>
                                <span></span>
                                <p>
                                    اینجا قدم به قدم مسیر ساختن عادت های جدید رو کنارت هستیم.
                                </p>
                            </li>
                            <li>
                                <span></span>
                                <p>عادت هایی که حس سرزنش رو با حس رضایت جایگزین می‌کنن.</p>
                            </li>
                        </ul>
                        <ul class="downloadApp">
                            <li class="appTitle">
                                <p>نسخه مستقیم WebApp</p>
                            </li>
                            <li>
                                <a href="https://webapp.sinaghafari.com/" target="_blank">
                                    <img src="{{ asset('landing-assets/img/webapp-2.png') }}" alt="img" />
                                </a>
                            </li>
                            <li class="appTitle">
                                <p>دریافت برای Android</p>
                            </li>
                            <li>
                                <a href="https://21dayapp.com/apks/21days.apk?v1{{ rand() }}" target="_blank">
                                    <img src="{{ asset('landing-assets/img/Android.png') }}" alt="img" />
                                </a>
                            </li>
                            <li class="appTitle">
                                <p>IOS دریافت برای</p>
                            </li>
                            <li>
                                <a href="https://sibapp.com/applications/21days?from=search" target="_blank">
                                    <img src="{{ asset('landing-assets/img/SibApp.png') }}" alt="img" />
                                </a>
                            </li>
                            <li>
                                <a
                                    href="https://sibche.com/applications/21days"
                                    target="_blank"
                                >
                                    <img src="{{ asset('landing-assets/img/Sibche.png') }}" alt="img" />
                                </a>
                            </li>
                            <li>
                                <a
                                    href="https://anardoni.com/ios/app/comdays21app"
                                    target="_blank"
                                >
                                    <img src="{{ asset('landing-assets/img/anardoni.png') }}" alt="img" />
                                </a>
                            </li>
                            <li>
                                <a
                                    href="https://iapps.ir/app/بیست-و-یک-روز/558496864"
                                    target="_blank"
                                >
                                    <img src="{{ asset('landing-assets/img/Iapps.png') }}" alt="img" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mainSecLeft">
                        <div class="mainSecVid">
                            <img src="{{ asset('landing-assets/img/gif-landing.gif') }}" alt="gif" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footerBox">
                    <div class="footerRght">
                        <div class="copyright">
                            🤞🏼 توسعه توسط تیم اکسیدو
                            <br />
                            Copyright© {{ \Carbon\Carbon::parse()->year }} exito
                        </div>
                        <ul>
                            <li>
                                <a href="http://instagram.com/exitomag" target="_blank">
                                    <img src="{{ asset('landing-assets/img/instagram.png') }}" alt="img" />
                                </a>
                            </li>
                            <li>
                                {{--<style>#zarinpal{margin:auto} #zarinpal img {width: 80px;}</style>--}}
                           {{--     <div id="zarinpal">

                                </div>   --}}
                                <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
                            </li>
                            <li>
                                <a
                                    href="https://trustseal.enamad.ir/?id=369400&code=nHVYWuZvWRQ9u2HVm1F2"
                                    target="_blank"
                                >
                                    <img src="{{ asset('landing-assets/img/namad.png') }}" alt="img" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footerImg">
                        <img src="{{ asset('landing-assets/img/footerImg.png') }}" alt="png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>

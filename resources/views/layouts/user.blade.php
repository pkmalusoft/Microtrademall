<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="theme-color" content="#00a2e8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
     <!-- Bootstrap Core CSS -->
    <!-- Bootstrap Select Option css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap-select.min.css') }}">
    <!-- Icons -->
    <link href="{{ asset('assets/plugins/icons/css/icons.css') }}" rel="stylesheet">
    <!-- Animate -->
    <link href="{{ asset('assets/plugins/animate/animate.css') }}" rel="stylesheet">
    <!-- Nice Select Option css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/nice-select/css/nice-select.css') }}">
    <!-- Bootsnav -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootsnav.css') }}" rel="stylesheet">
    <!-- Aos Css -->
    <link href="{{ asset('assets/plugins/aos-master/aos.css') }}" rel="stylesheet">
    <!-- Slick Slider -->
    <link href="{{ asset('assets/plugins/slick-slider/slick.css') }}" rel="stylesheet">    
    <!-- Custom style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsiveness.css') }}" rel="stylesheet">
    <!-- Custom Color -->
    <link href="{{ asset('assets/css/skin/default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ asset('js/popper.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js" defer></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ asset('assets/plugins/aos-master/aos.js') }}" defer></script>
    <script src="{{ asset('js/owl.js') }}" defer></script>
    <script src="https://cdn.tiny.cloud/1/le3ut3ury87quekcdimw4afc2jink9e9bz0o9i8hrzzzr8rp/tinymce/5/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--<script src="{{ mix('js/app.js') }}" defer></script>    -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
</head>
<body class="@guest not-logged-in @else logged-in @endif">
    <div id="app" class="blue-skin">
        <div class="siteHeader">
            <div class="row flexy justify-content-between align-items-center">


                <div class="loginsideBar" style="display: none;">
                    <span></span><span></span><span></span>
                </div>



                <div class="leftLogo col-md-5">
                    <a  href="{{URL::to('/')}}">
                         <!-- {{ config('app.name', 'Laravel') }} -->
                        <img src="{{ asset('assets/img/logo.png') }}" class="logo logo-display" alt="">
                    </a>
                </div>
                <div class="rightHeader">
                    <a class="btn btn-primary" href="{{URL::to('/')}}"><span class="fa fa-laptop"></span> &nbsp;&nbsp;Back to Website</a>
                    <a class="btn btn-primary" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout &nbsp;&nbsp;<span class="fa fa-sign-out fa-fw"></span></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    @if(isset($userImage) && is_array($userImage))
                    <img style="border-radius:50%; width:40px; height:40px; object-fit:cover;object-position: top;" src="{{asset('media/'.$userImage[0]->picture)}}"/>
                	@endif
                </div>
            </div>
        </div>  

        <main class="mainBlock">
            @include('login.sidebar')
            @yield('content')
        </main>



 
    </div>
    
    @yield('js')



</body>
</html>

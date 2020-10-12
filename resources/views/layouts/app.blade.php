<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-166883332-2"></script>
<script src="https://kit.fontawesome.com/4c94dd4150.js" crossorigin="anonymous"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-166883332-2');
</script>

    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
       <meta name="theme-color" content="#00a2e8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Micro Investor Mall') }}</title>
    <title> Microinvestmall</title>
    <!-- Styles -->
     <!-- Bootstrap Core CSS -->

     <meta property="og:image" content="@yield('ogicon')">

    <!-- Bootstrap Select Option css -->
    <link rel="icon" type="image/png" href="{{asset('assets/img/fav.png')}}">


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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css" rel="stylesheet">
    <!-- Custom Color -->
    <link href="{{ asset('assets/css/skin/default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom/main.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ asset('js/popper.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/owl.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js" defer></script>
    <script src="{{ asset('assets/plugins/nice-select/js/jquery.nice-select.min.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/aos-master/aos.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/slick-slider/slick.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap-wysihtml5.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootsnav.js') }}" defer></script>
    <script src="{{ asset('assets/js/custom.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
</head>

<body class="@guest not-logged-in @else logged-in @endif">

    <div id="app" class="blue-skin">
 

        <nav class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav text-center">
            <div class="container">
            
                <!-- Start Logo Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{URL::to('/')}}">
                         <!-- {{ config('app.name', 'Laravel') }} -->
                        <img src="{{ asset('assets/img/logo.png') }}" class="logo logo-display" alt="">
                        <img src="{{ asset('assets/img/logo.png') }}" class="logo logo-scrolled" alt="">
                    </a>

                    <a href="{{URL::to('/login')}}" class="userIcon" style="display: none;">
                         <img src="{{ asset('assets/img/user.svg') }}" width="20px" alt="">
                    </a>

                </div>
                <!-- End Logo Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                
                    <!-- <ul class="nav navbar-nav noFloat d-inline" data-in="fadeInDown" data-out="fadeOutUp"> -->
                    <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
                    
                        
                         <li class="dropdown">
                            <a href="javascipt:void(0)}" class="dropdown-toggle" data-toggle="dropdown">Looking for</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{URL::to('/investors')}}">Investors</a></li>
                                {{-- <li><a href="{{URL::to('/investees')}}">investees</a></li> --}}
                                <li><a href="{{URL::to('/franchisers')}}">Frachisers</a></li>
                                {{-- <li><a href="{{URL::to('/franchisee-seeker')}}">Franchisees</a></li> --}}
                                <li><a href="{{route('all.loanSeekers')}}">Loans</a></li>
                                {{-- <li><a href="{{route('loanProviders')}}">Loan Providers</a></li> --}}
                            </ul>
                        </li>
                       
                            @if(count($servicesList) > 0)
                            <li class="dropdown maximizeMenu">
                                <a  class="dropdown-toggle" data-toggle="dropdown">Services</a>
                                <ul class="dropdown-menu">
                                    @foreach($servicesList as $service)
                                        <li><a href="{{URL::to('/service',$service->id)}}">{{$service->title}}</a></li>
                                    @endforeach

                                </ul>
                            </li>
                            @endif

                       
                        <li><a href="{{URL::to('/pricing')}}">Pricing</a></li>
                        <li><a href="{{URL::to('/about-us')}}">About</a></li>
                        <li><a href="{{URL::to('/contact')}}">Contact</a></li>
                        
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        @auth
                            <li class="br-right"><a href="{{ route('dashboard') }}"><i class="login-icon ti-user"></i>Dashboard</a></li>
                            <li class="sign-up"><a class="btn-signup red-btn" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="ti-shift-right"></span>Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </li> 
                            @else
                                <li class="br-right"><a href="{{ route('login') }}"><i class="login-icon ti-user"></i>Login</a></li>
                                <li class="sign-up"><a class="btn-signup red-btn" href="{{ route('register') }}"><span class="ti-briefcase"></span>Sign Up</a></li> 
                            @endif
                             <div id="google_translate_element"></div>
                    </ul>
                  
                </div>
                <!-- /.navbar-collapse -->
            </div>   
        </nav>
 

        <main class="mainBlock">
            @yield('content')
        </main>



        <!-- ================= footer start ========================= -->
        <footer class="dark-bg footer">
            <div class="container">
               <div id="google_translate_element"></div>
                <!-- Row Start -->
                <div class="row">
                
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <h4>Quick Links</h4>
                                <ul>
                                    <li><a href="{{URL::to('/')}}">Home</a></li>
                                    <li><a href="{{URL::to('/pricing')}}">Pricing</a></li>
                                    <li><a href="{{URL::to('/terms-conditions')}}">Terms & Conditions</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <h4>Business Service</h4>
                                <ul class="widerMenu">
                                     @if(count($servicesList) > 0)
                                        @foreach($servicesList as $key => $service)
                                            <li><a href="{{URL::to('/service',$service->id)}}">{{$service->title}}</a></li>
                                        @endforeach
                                    @endif 
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-3 contactFt">
                                <h4>Contact</h4>
                                <ul>
                                    <li><i class="theme-cl font-30 ti-location-pin"></i><p>Tejas Arcade, 3rd Floor, No 527/B, 1st Main Road, Ward No 9, Dr. Rajkumar Road, Rajajinagar, Bangalore-560010</p></li>
                                    <li><i class="theme-cl font-30 ti-themify-favicon"></i><a href="tel:8089501000">+91 8089501000 <br/> +91 6361886189</a></li>
                                    <li><i class="theme-cl font-30 ti-clip"></i><a href="mailto: pradeep@microinvestmall.com">pradeep@microtrademall.com</a></li>
                                   
                                    
                                </ul>

                                <div class="f-social-box">
                                    <ul>
                                        
                                        <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook facebook-cl"></i></a></li>
                                        <li><a href="http://www.twitter.com/" target="_blank"><i class="fa fa-twitter twitter-cl"></i></a></li>
                                        <li><a href="http://www.instagram.com/" target="_blank"><i class="fa fa-instagram instagram-cl"></i></a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Row Start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright text-center">
                            <p>&copy; Copyright <?php echo date('Y');?> | an initiative of Malusoft India</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </footer>
    </div>
    
    @yield('js')
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ecb608ac75cbf1769ef04f0/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
   <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en', includedLanguages: 'en,es,pl,pt,hi,zh-CN,zh-TW,ar',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
     $('document').ready(function () {
            $('#google_translate_element').on("click", function () {

                // Change font family and color
                // $("iframe").contents().find(".goog-te-menu2-item div, .goog-te-menu2-item:link div, .goog-te-menu2-item:visited div, .goog-te-menu2-item:active div") //, .goog-te-menu2 *
                // .css({
                //     'color': '#544F4B',
                //     'background-color': '#e3e3ff',
                //     'font-family': '"Open Sans",Helvetica,Arial,sans-serif'
                // });

                // Change hover effects  #e3e3ff = white
                // $("iframe").contents().find(".goog-te-menu2-item div").hover(function () {
                //     $(this).css('background-color', '#17548d').find('span.text').css('color', '#e3e3ff');
                // }, function () {
                //     $(this).css('background-color', '#e3e3ff').find('span.text').css('color', '#544F4B');
                // });

                // // Change Google's default blue border
                // $("iframe").contents().find('.goog-te-menu2').css('border', '1px solid #17548d');

                // $("iframe").contents().find('.goog-te-menu2').css('background-color', '#e3e3ff');

                // Change the iframe's box shadow
                $(".goog-te-menu-frame").css({
                    '-moz-box-shadow': '0 3px 8px 2px #666666',
                    '-webkit-box-shadow': '0 3px 8px 2px #666',
                    'box-shadow': '0 3px 8px 2px #666'
                });
            });
        });
    </script>
    
</body>
</html>

@extends('layouts.app')

@section('content')

<div class="page-title light" style="background:url(assets/img/slider-2.jpg);">
    <div class="container">
        <div class="page-caption">
            <h2>Create an Account</h2>
            <p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Sign Up</p>
        </div>
    </div>
</div>

<section class="gray">
    <div class="container">
        <div class="container">
            <div class="log-box">
                <div class="text-center"><img src="assets/img/logo.png" class="img-responsive" alt=""></div>
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if(Session::has('verifyFail'))
                 <div class="alert alert-danger">
                    {!! session('verifyFail') !!}
                </div>
                @endif

                <form method="POST" class="log-form" action="{{ route('register') }}" id="registerForm">
                    @csrf

                @if(Session::has('userData'))
                        <div class="otpBlock row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter 6 Digits OTP sent on   ******{{ substr(old('contact'),-4) }}</label>
                                    <input id="otp" type="number" class="form-control" name="otp">
                                 @if(Session::has('otperror'))
                                 <div class="alert alert-danger">
                                    {!! session('otperror') !!}
                                </div>
                                 @endif

                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn theme-btn btn-m">Create An Account</button>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group"  id="resendOtp" style="display:none;">
                                    <a href="javascript:void(0)" onclick="resendOtp();" class="btn theme-btn btn-m">Resend OTP</a> 
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="form-group">
                                    <a href="{{route('reregister')}}" class="btn btn-m">Cancel</a> 
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <p class="otpNotif" style="font-weight: 500;font-size: 15px;">You'll be able to resend OTP after <span id="clock">03:00</span> minutes.</p>
                            </div>

                        </div>
                    <style>.formWrapper{display: none;}</style>
                    @else

                    <div class="formWrapper">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Your Name" autofocus>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Your Email..">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Contact No. (For OTP)</label>
                                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" placeholder="Contact no.">
                            </div>
                        </div>
                        
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sign up as:</label>

                                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="">Choose</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{ucfirst($role->title)}} ( {{$role->description}} )</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <div class="row mx-0">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" name="password" required autocomplete="new-password" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group pointer">
                                <span class="custom-checkbox">
                                    <input type="checkbox" name="terms" id="terms" checked value="1" class="form-check-input">
                                    <label for="terms"></label>I accept with the <a href="{{ URL::to('/terms-conditions')}}">Terms & Conditions</a>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6">
                                <div class="form-group  mrg-top-15">
                                    <button type="submit" class="btn theme-btn btn-m">Create An Account</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-right mrg-top-15">
                                     <a  href="{{ url('auth/google') }}"  class="btn  btn-m loginG">
                                  <strong><i class="fa fa-google-plus"></i>Login With Google</strong>
                                </a> 
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center">
                            
                        </div>
                         {{-- <div class="row justify-content-between align-items-center">
                            <div class="col-md-12">
                                <div class="form-group text-center mrg-top-15">
                                     <a href="{{url('/facebook/redirect')}}"  class="btn theme-btn btn-m">
                                  <strong>Login With Facebook</strong>
                                </a> 
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    @endif  
                </form>
                
                <!-- <div class="log-option"><span>OR</span></div> -->
                
               <!--  <div class="row">
                    <div class="col-md-6">
                        <a href="#" title="" class="fb-log-btn log-btn"><i class="fa fa-facebook"></i>SignUP With Facebook</a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" title="" class="gplus-log-btn log-btn"><i class="fa fa-google-plus"></i>SignUp With Google+</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>


@endsection

@section('js')
<script>
    
    function resendOtp(){
        $('[name=otp]').attr('name','');
        $('#registerForm').submit();
    }


    $('[name=role]').val("{{old('role')}}");
    function countdown(element, minutes, seconds) {
    if(element.length){
        // set time for the particular countdown
        var time = minutes*60 + seconds;
        var interval = setInterval(function() {
            var el = document.getElementById(element);
            // if the time is 0 then end the counter
            if (time <= 0) {
                var text = "";
                $('#resendOtp').fadeIn(); 
                $('.otpNotif').fadeOut(); 
                clearInterval(interval);
                return;
            }
            var minutes = Math.floor( time / 60 );
            if (minutes < 10) minutes = "0" + minutes;
            var seconds = time % 60;
            if (seconds < 10) seconds = "0" + seconds; 
            var text = minutes + ':' + seconds;
            el.innerHTML = text;
            time--;
        }, 1000);
    }
}
countdown('clock', 0, 180);
</script>
@endsection

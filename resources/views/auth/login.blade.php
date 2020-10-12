@extends('layouts.app')

@section('content')

<div class="page-title light" style="background:url(assets/img/slider-2.jpg);">
    <div class="container">
        <div class="page-caption">
            <h2>LOGIN</h2>
            <p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Login</p>
        </div>
    </div>
</div>

<section class="gray">
    <div class="container">
        <div class="container">
            <div class="log-box small"> 
                <div class="loginBlock">
                    <div class="text-center"><img src="assets/img/logo.png" class="img-responsive" alt=""></div>
                    <div  id="employer">
                        <form id="loginform" action="{{ route('login') }}" method="post" class="loginForm siteForm">
                            @csrf
                            <div class="form-group">
                                <label>Email/Username</label>
                                <input type="text" value="{{ old('username') ?: old('email') }}" name="login" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username or Email">
                                @error('username')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                                @error('email')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" value="{{ old('password') }}" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <span class="custom-checkbox">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember"></label>Remember me
                                </span>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="fl-right"> {{ __('Forgot Your Password?') }}</a>
                                @endif
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="submit" class="btn theme-btn full-width btn-m">LOGIN </button>
                            </div>
                             <div class="">
                                <div class="form-group text-center mrg-top-15">
                                     <a  href="{{ url('auth/google') }}"  class="btn full-width btn-m loginG">
                                  <strong><i class="fa fa-google-plus"></i>Login With Google</strong>
                                </a> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>



<?php /*
<section class="loginBlock bannerHeight">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <form id="loginform" action="{{ route('login') }}" method="post" class="underlineForm">
                        @csrf
                    <div class="formGroup"> 
                        <label><input type="text" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" placeholder="Username or Email" required autocomplete="email" autofocus></label> 
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="formGroup"> 
                        <label><input type="text" name="password" value="{{ old('password') }}" class="@error('password') is-invalid @enderror" placeholder="Password"></label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="formSubmit"> 
                        <button type="submit" name="submit">LOGIN</button> 
                    </div>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>*/?>
 
@endsection

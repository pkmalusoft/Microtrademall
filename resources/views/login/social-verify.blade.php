@extends('layouts.app')

@section('content')

<div class="page-title light" style="background:url(assets/img/slider-2.jpg);">
    <div class="container">
        <div class="page-caption">
            <h2>Verify Register</h2>
            <p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Verify</p>
        </div>
    </div>
</div>

<section class="gray">
    <div class="container">
        <div class="container">
            <div class="log-box small"> 
                <div class="loginBlock">
                    <div class="text-center"><img src="{{asset('assets/img/logo.png')}}" class="img-responsive" alt=""></div>
                    <div  id="employer">
                         @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" class="log-form" action="{{ route('social.register') }}" id="registerForm">
                             @csrf
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
                        <div class="col-md-12">
                             <div class="form-group pointer">
                                <span class="custom-checkbox">
                                    <input type="checkbox" name="terms" id="terms" checked value="1" class="form-check-input">
                                    <label for="terms"></label>I accept with the <a href="{{ URL::to('/terms-conditions')}}">Terms & Conditions</a>
                                </span>
                            </div>
                        </div>
                         <div class="row justify-content-between align-items-center">
                            <div class="col-md-12">
                                <div class="form-group text-center mrg-top-15">
                                    <button type="submit" class="btn theme-btn btn-m">Create An Account</button>
                                </div>
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
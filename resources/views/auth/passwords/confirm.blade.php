@extends('layouts.app')

@section('content')

<div class="page-title light" style="background:url(assets/img/slider-2.jpg);">
    <div class="container">
        <div class="page-caption">
            <h2>Reset Password6522</h2>
            <p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Reset Password</p>
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
                       <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn theme-btn btn-m">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link theme-btn btn-m" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
 
@endsection


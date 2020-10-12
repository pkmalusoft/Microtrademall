@extends('layouts.app')

@section('content')

<div class="page-title light" style="background:url(assets/img/slider-2.jpg);">
    <div class="container">
        <div class="page-caption">
            <h2>Reset Password</h2>
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
                           @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                       <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn theme-btn btn-m">
                                    {{ __('Send Password Reset Link') }}
                                </button>
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


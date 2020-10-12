@extends('layouts.user')

@section('content')
    <div class="authRightBlock">
       <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-left">
                    <h4 class="mt-5 mb-5">Add Users</h4>
                </div>
            </div>
           
            <div class="panel-body panel-body-with-table">
                @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-ok"></span>
                        {!! session('success_message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                @endif

                 @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                
                <form method="POST" class="log-form" action="{{ route('createuser') }}" id="registerForm">
                    @csrf
                    <div class="formWrapper">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" autofocus>
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
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-12">
                                <div class="form-group  mrg-top-15">
                                    <button type="submit" class="btn theme-btn btn-m">Create An Account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
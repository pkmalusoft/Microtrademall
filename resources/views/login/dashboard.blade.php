@extends('layouts.user')

@section('content')
	 <div class="authRightBlock">
        <div class="panel panel-default" style="min-height: 400px;">
            <div class="panel-heading clearfix">
                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Welcome {{ucfirst(Auth::user()->name)}}</h4>
				</span>				
            </div>
            <div class="panel-body clearfix">
            	 @if(Session::has('otp'))
                 <div class="alert alert-success">
                    {{ session('otp') }}
                </div>
                 @endif
            	<!-- If User is verified -->
            @if(Auth::user()->verification != '0')
            	<?php
            		echo date('dS F, Y').'<br><br>';
				    $time = date("H");
				    if ($time < "12") {
				        echo "Good morning";
				    } else
				    if ($time >= "12" && $time < "17") {
				        echo "Good afternoon";
				    } else
				    if ($time >= "17" && $time < "19") {
				        echo "Good evening";
				    } else
				    if ($time >= "19") {
				        echo "Good night";
				    }
			    ?>
            	<!-- If User is Not verified -->

			    @else 
		    		<form action="{{ route('verifyManualUser') }}" method="post">
		    			@csrf
                		@if(!Session::has('verifyMe'))
					    	<h4>Your Account is not verified yet.</h4><br>
					    	<p>Please click the button below to recieve OTP on your register number 
					    		<strong>*****{{ substr(Auth::user()->contact, 5) }}</strong> for the verification.</p><br>
				    			<input type="submit" class="btn btn-primary" name="submit" value="Send OTP"/>

			   			 @else 
		    			<div class="otpBlock row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter 6 Digits OTP to verify account.</label>
                                    <input id="otp" type="number" class="form-control" name="otp">
                                 @if(Session::has('otperror'))
                                 <div class="alert alert-danger">
                                    {{ session('otperror') }}
                                </div>
                                 @endif
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
		   			 @endif
		    		</form>

		    @endif
            </div>

        </div>
    </div>	

@endsection

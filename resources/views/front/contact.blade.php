@extends('layouts.app')

@section('content')

<!-- ======================= Page Title ===================== -->
		<div class="page-title light" style="background:url(assets/img/slider-2.jpg);">
			<div class="container">
				<div class="page-caption">
					<h2>Get In Touch</h2>
					<p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Contact</p>
				</div>
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ================ Office Address ======================= -->
		<section>
			<div class="container">
				<div class="col-md-10 col-md-offset-1 col-sm-12 translateY-60">
					<div class="col-md-6 col-sm-6">
						<div class="detail-wrapper text-center padd-top-40 mrg-bot-10 padd-bot-40 light-bg">
							<i class="theme-cl font-30 ti-location-pin"></i>
							<h4>India Office</h4>
							Tejas Arcade,  3rd Floor,
                            No 527/B, 1st Main Road,<br/>
                            Ward No 9, Dr. Rajkumar Road,<br/>
                            Rajajinagar, Bangalore-560010
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="detail-wrapper text-center padd-top-40 mrg-bot-10 padd-bot-40 light-bg">
							<i class="theme-cl font-30 ti-themify-favicon"></i>
							<h4>Get in Touch </h4>
						    Tel: 080-68133626 <br/>
						    Mob: +91 8089501000 | +91 6361886189  
						    <br/>pradeep@microinvestmall.com
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ================ End Office Address ======================= -->
		
		<!-- ================ Fill Forms ======================= -->
		<section class="padd-top-20">
			<div class="container">
				<div class="col-md-6 col-sm-6">
					<form action="{{ route('contactForm') }}" method="post" class="contForm">
						@csrf
						<div class="form-group">
							<label>Name:</label>
							<input type="text" class="form-control" placeholder="Name" name="username" />
						</div>
						<div class="form-group">
							<label>Email:</label>
							<input type="email" class="form-control" placeholder="Email" name="email" />
						</div>
						<div class="form-group">
							<label>Message:</label>
							<textarea class="form-control height-120" placeholder="Message" name="message"></textarea>
						</div>
						<div class="form-group">
							<button class="btn theme-btn" name="submit">Send Request</button>
						</div>
					</form>
					 @if(isset($msg))
			         <div class="alert alert-success">
			            <span class="glyphicon glyphicon-ok"></span>
			            {!! $msg !!}
			            <button type="button" class="close" data-dismiss="alert" aria-label="close">
			            <span aria-hidden="true">&times;</span>
			            </button>
			         </div>
			         @endif
				</div>
				<div class="col-md-6 col-sm-6">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.4403685518564!2d77.5524113148497!3d13.007605217606553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3d83b4dd2565%3A0x5ea6549cc717682!2sRegus%20-%20Bangalore%2C%20Tejas%20Arcade!5e0!3m2!1sen!2sin!4v1589438712161!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				</div>
			</div>
		</section>
		<!-- ================ End Fill Forms ======================= -->
		
@endsection


@section('js')
<script>
	 @if(isset($msg))
	 	$(function(){
	 		$('body,html').animate({
	 			scrollTop: $('.contForm').offset().top
	 		},1000);
	 	});
	 @endif
</script>
@endsection
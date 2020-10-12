@extends('layouts.app')

@section('content')

<div class="page-title light" style="background:url(assets/img/banner-4.jpg);">
	<div class="container">
		<div class="page-caption">
			<h2>Support</h2>
			<p><a href="/" title="Home">Home</a> <i class="ti-arrow-right"></i> About Us</p>
		</div>
	</div>
</div>

    <!-- ======================= Start Banner ===================== -->
    <section class="supportBox">
	<div class="container">
		<div class="panel-group style-1" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="register">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							How to Register ?
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse  supportBlock" role="tabpanel" aria-labelledby="register">
								<div class="panel-body">
									<p>Please follow the following steps:</p>
			<div class="supportItem">
				<div class="supportLeft">
					<h4>Step 01:</h4>
					<p>Click on signup button</p>
					</div>
					<div class="supportDesc">
						<img src="{{url('public/assets/img/gg.jpg')}}" alt="">
					</div>
				</div>

				<div class="supportItem">
				<div class="supportLeft">
					<h4>Step 02:</h4>
					<p> If you have already gmail account then click on google button.Otherwise you can skip this step and follow the step 04. </p>
					</div>
					<div class="supportDesc">
						<img src="{{url('public/assets/img/login-screen.jpg')}}" alt="">
					</div>
				</div>

				<div class="supportItem">
				<div class="supportLeft">
					<h4>Step 03:</h4>
					<p>Choose your role and click on create account button. After that skip Step 4 and Step 5 
					and proceed with Step 6</p></div>
					<div class="supportDesc">
						<img src="{{url('public/assets/img/choose-rl.jpg')}}" alt="">
					</div>
				</div>
				<div class="supportItem">
					<div class="supportLeft">
						<h4>Step 04:</h4>
						<p>If you don't have google account then you can fill the form and click on the create
						Account button</p>
						</div>
						<div class="supportDesc">
							<img src="{{url('public/assets/img/login-screen-2.jpg')}}" alt="">
						</div>
				</div>
				<div class="supportItem">
					<div class="supportLeft">
						<h4>Step 05:</h4>
						<p>Fill the OTP</p>
						</div>
						<div class="supportDesc">
							<img src="{{url('public/assets/img/otp.jpg')}}" alt="">
						</div>
				</div>

				<div class="supportItem">
					<div class="supportLeft">
						<h4>Step 06:</h4>
						<p>This will redirect to the dashboard page. Click on edit profile select the services that you want to provide and fill your details like your location, About etc.</p>
						</div>
						<div class="supportDesc">
							<img src="{{url('public/assets/img/ds.jpg')}}" alt="">
						</div>
				</div>
					<div class="supportItem">
					<div class="supportLeft">
						<h4>Step 07:</h4>
						<p>Congratulations your profile is ready.</p>
						</div>
						<div class="supportDesc">
						</div>
				</div>

			</div>	
				</div>
			</div>
{{-- 2 faq --}}
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="web-development">
					<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							How to Buy Plan?
						</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="web-development">
					<div class="panel-body">
						<p>Please follow the following steps:</p>
			<div class="supportItem">
				<div class="supportLeft">
					<h4>Step 01:</h4>
					<p>Click on Back to Website button</p>
					</div>
					<div class="supportDesc">
						<img src="{{url('public/assets/img/plan-buy.jpg')}}" alt="">
					</div>
				</div>
					<div class="supportItem">
				<div class="supportLeft">
					<h4>Step 02:</h4>
					<p>Click on Pricing</p>
					</div>
					<div class="supportDesc">
						<img src="{{url('public/assets/img/plan-2.jpg')}}" alt="">
					</div>
				</div>
					<div class="supportItem">
				<div class="supportLeft">
					<h4>Step 03:</h4>
					<p>You can select any plan and then click on Buy Now Button and do the payment</p>
					</div>
					<div class="supportDesc">
						<img src="{{url('public/assets/img/plan-3.jpg')}}" alt="">
					</div>
				</div>
					</div>
				</div>
			</div>



{{-- 3 --}}

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="profile">
					<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsethree" aria-expanded="false" aria-controls="collapseTwo">
							How to View your Profile?
						</a>
					</h4>
				</div>
			<div id="collapsethree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="profile">
					<div class="panel-body">
						<p>Please follow the following steps:</p>
			<div class="supportItem">
				<div class="supportLeft">
					<h4>Step 01:</h4>
					<p>Click on Dashboard button</p>
					</div>
					<div class="supportDesc">
						<img src="{{url('public/assets/img/back-to.jpg')}}" alt="">
					</div>
				</div>
				<div class="supportItem">
				<div class="supportLeft">
					<h4>Step 02:</h4>
					<p>You will be redirected to your profile page</p>
					</div>
					<div class="supportDesc">
						<img src="{{url('public/assets/img/profile.jpg')}}" alt="">
					</div>
				</div>
					
					</div>
				</div>
			</div>

		</div>
			
		
	</div>
	 </section>
@endsection

@section('js')
	
@endsection


@extends('layouts.app')

@section('content')
<!-- ======================= Start Page Title ===================== -->
	<div class="page-title light" style="background:url(assets/img/slider-2.jpg);">
		<div class="container">
			<div class="page-caption">
				<h2>Pricing</h2>
				<p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Pricing</p>
			</div>
		</div>
	</div>
<!-- ======================= End Page Title ===================== -->
		
<!-- ================ Pricing Table ======================= -->
		<section class="gray">
			<div class="container">
			
    <div class="pricingPlan">
				@if(isset($plans))
					@foreach($plans as $plan)
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="package-box">
							<div class="package-header">
									<span class="splOffer"><b>Free till <br/> 30 Aug, 2020</b></span>
								<i class="fa fa-cog" aria-hidden="true"></i>
								<h3>{{ $plan->title }}</h3>
							</div>
							<div class="package-price">
								<h2><sup>Rs. </sup>{{ $plan->price }}<span>&times</span>
									<sub>/{{ $plan->duration }} days</sub></h2>
							</div>
							<div class="package-info">
								<ul>
									@php
									$features = explode(',',$plan->services); 
									@endphp 
									@foreach($features as $feature)
										<li>{{ $feature }}</li>
									@endforeach
<!-- 								<li>3 Designs</li>
								<li>3 PSD Designs</li>
								<li>4 color Option</li>
								<li>10GB Disk Space</li>
								<li>Full Support</li>
 -->								</ul>
							</div>
							<!-- <a href="{{ URL::to('/buy-plan',$plan->id) }}" class="btn btn-package">Buy Now</a> -->
							<a href="{{ URL::to('/free-plan',$plan->id) }}" class="btn btn-package">Buy Now</a>
						</div>
					</div>
					@endforeach
				@endif
				</div>
				
				<!-- <div class="col-md-4 col-sm-4">
					<div class="active package-box">
						<div class="package-header">
							<i class="fa fa-star-half-o" aria-hidden="true"></i>
							<h3>Standard</h3>
						</div>
						<div class="package-price">
							<h2><sup>$ </sup>110<sub>/Month</sub></h2>
						</div>
						<div class="package-info">
							<ul>
							<li>3 Designs</li>
							<li>3 PSD Designs</li>
							<li>4 color Option</li>
							<li>10GB Disk Space</li>
							<li>Full Support</li>
							</ul>
						</div>
						<button type="submit" class="btn btn-package">Sign Up</button>
					</div>
				</div>
				
				<div class="col-md-4 col-sm-4">
					<div class="package-box">
						<div class="package-header">
							<i class="fa fa-cube" aria-hidden="true"></i>
							<h3>Premium</h3>
						</div>
						<div class="package-price">
							<h2><sup>$ </sup>170<sub>/Month</sub></h2>
						</div>
						<div class="package-info">
							<ul>
							<li>3 Designs</li>
							<li>3 PSD Designs</li>
							<li>4 color Option</li>
							<li>10GB Disk Space</li>
							<li>Full Support</li>
							</ul>
						</div>
						<button type="submit" class="btn btn-package">Sign Up</button>
					</div>
				</div> -->
				
			</div>
		</section>
		<!-- ================ End Pricing Table ======================= -->
@endsection
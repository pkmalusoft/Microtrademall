@extends('layouts.app')

@section('content')

<div class="page-title light" style="background:url(assets/img/banner-4.jpg);">
	<div class="container">
		<div class="page-caption">
			<h2>Browse Investors</h2>
			<p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Browse Job</p>
		</div>
	</div>
</div>
<!-- ======================= End Page Title ===================== -->

<!-- ====================== Start Job Detail 2 ================ -->
<section class="gray">
	<div class="container">
		
		<!-- row -->
		<div class="row">
			<!-- Start Sidebar -->
			<div class="col-md-3 col-sm-12 jv-side">
				
				<div class="widget-boxed padd-bot-0 lg zx100">
					<div class="widget-boxed-body map-searches">
						<div class="">
							@if(isset($locs))
							<form action="{{route('filterInvestor')}}" method="Post" accept-charset="utf-8">
								@csrf
							<select name="location" class="form-control mapicon">
								<option value="">Choose Location</option>
								
									@foreach($locs as $loc)
										<option value="{{ $loc->city }}">{{ $loc->city}}</option>
									@endforeach
								
							</select>

							
							@endif
							
						</div>
					</div>
				</div>
				
				<div class="widget-boxed padd-bot-0">
					<div class="widget-boxed-header">
						<h4>Investor Type</h4>
					</div>
					<div class="widget-boxed-body">
						<div class="side-list no-border">
							<ul>
								<li>
									<span class="custom-radio">
										<input type="radio" id="1" name="investortype" value="sleeping">
										<label for="1"></label>
									</span>
									Sleeping Partner
								</li>
								<li>
									<span class="custom-radio">
										<input type="radio" id="2" name="investortype" value="working">
										<label for="2"></label>
									</span>
									Working Partner
								</li>
								
							</ul>
						</div>
					</div>
				</div>
				<input type="submit" name="submit" value="submit" class="btn theme-btn btn-m"/>
				</form>
				
			</div>
			
			<!-- Start Job List -->
			<div class="col-md-9 col-sm-12">
				
				
				<div class="row">
					<!-- Single Employee List -->
					
					
					@if(count($users) > 0)

						@foreach($users as $user)
						<div class="col-md-4 col-sm-6">
							<div class="contact-box">
								<div class="contact-img">
									<img src="{{ asset('media/'.$user->picture) }}" class="profilepic img-circle img-responsive" alt="">
								</div>
								<div class="contact-caption">
									<h4 class="font-16 font-midium">{{$user->user['name']}}</h4>
									@if(!empty($user->maxinvestment))
										<span>Max: <strong>Rs.{{$user->maxinvestment}}</strong></span>
									@endif
								</div>
								<div class="contact-footer">
									
									
									<a href="{{ route('all.profile', $user->id) }}" class="left-br col-half">
										<span class="con-profile"><i class="ti-eye"></i>Quick View</span>
									</a>
								</div>
							</div>
						</div>

						@endforeach
					@else
						<h3 class="text-center notFound">No Result Found!</h3>
					@endif
				</div>
				
				<div class="row">
					<div class="col-md-12 mrg-top-20">
						<div class="text-center">
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!-- End Row -->
		
	</div>
</section>

<!-- ====================== End Job Detail 2 ================ -->

@endsection
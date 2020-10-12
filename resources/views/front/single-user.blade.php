@extends('layouts.app')
@section('ogicon', asset('media/'.$user->usermeta->picture))
@section('content')
<!-- ======================= Start Page Title ===================== -->
<div class="page-title light">
	<div class="container">
		<div class="col-sm-7">
			<div class="page-caption">
				<h2>{{ $user->name }}</h2>
				<p><a href="#" title="Home">{{ $user->roletitle	}}</a></p>
			</div>
		</div>
		<!-- <div class="col-sm-5 text-right mrg-top-30">
				<button type="submit" class="btn btn-m btn-success">Contact</button>
		</div> -->
	</div>
</div>
<!-- ======================= End Page Title ===================== -->


<!-- ====================== Resume Detail ================ -->
<section class="gray">
	<div class="container">
		<!-- row -->
		<div class="row">
			
			<div class="col-md-8 col-sm-12">
				
				<div class="detail-wrapper">
					<div class="detail-wrapper-body">
						
						<div class="text-center userPic">
							<img src="{{ asset('media/'.$user->usermeta->picture) }}" class="img-circle" alt=""/>
							<h3 class="meg-0 text-capitalize">{{ $user->name }}</h3>
							<p>{{ $user->usermeta->profile }}</p>
							@if($user->role == 3)
								<div class="text-left mrg-bot-30">
									@if($user->usermeta->services != null)
									<h4 class="mrg-bot-10"><strong>Services:</strong></h4>
									<ul class="list-unstyled text-left serviceLists">
										@foreach($servicesList as $key => $srv)
											@if(in_array($srv->id, json_decode($user->usermeta->services)))
												<li><i class="fa fa-check"></i> {{ $srv->title }} </li>
											@endif
										@endforeach
									</ul>
									@endif
								</div>
								<!-- INVESTORS -->
							@elseif($user->role == 2)
								<div class="text-left mrg-bot-30">
									<h4 class="mrg-bot-10"><strong>Details:</strong></h4>
									<ul class="list-unstyled text-left serviceLists text-capitalize">
										<li><i class="fa fa-check"></i> 
											{{ $user->usermeta->investortype }} Partner</li>
										<li><i class="fa fa-check"></i> Max Investment:
											 {{ $user->usermeta->maxinvestment?? 'Not Given'}}</li>
										@if($user->usermeta->lookingForFranchisee == 1)
											<li><i class="fa fa-check"></i>Looking for Franchisee</li>
										@endif
										@if($user->usermeta->franchiser == 1)
											<li><i class="fa fa-check"></i>Franchisee Provider</li>
										@endif
									</ul>
								</div>
							@endif
							
							@if($user->role == 3)
							<div class="mrg-bot-10 text-left">
								<h4 class="mrg-bot-10"><strong>Skills:</strong></h4>
								@if($user->usermeta->skills != '')
								@foreach(explode(',',$user->usermeta->skills) as $skill)
								<span class="skill-tag">{{ $skill }}</span>
								@endforeach
								@endif
							</div>
							@endif
						</div>
						
						<!-- <div class="row profileDetails">
								<div class="col-sm-4 mrg-bot-10">
										<i class="ti-location-pin padd-r-10"></i> {{ $user->usermeta->location }}
								</div>
								<div class="col-sm-4 mrg-bot-10">
										<i class="ti-email padd-r-10"></i><a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
								</div>
								<div class="col-sm-4 mrg-bot-10">
										<i class="ti-mobile padd-r-10"></i><a href="tel:{{ $user->contact }}">{{ $user->contact }}</a>
								</div>
								<div class="col-sm-4 mrg-bot-10">
										<i class="ti-credit-card padd-r-10"></i>$12/Hour
								</div>
								<div class="col-sm-4 mrg-bot-10">
										<i class="ti-shield padd-r-10"></i>{{ $user->usermeta->experience }}
								</div>
								<div class="col-sm-4 mrg-bot-10">
										<span class="skill-tag">css</span>
										<span class="skill-tag">HTML</span>
										<span class="skill-tag">Photoshop</span>
								</div>
						</div> -->
						
					</div>
				</div>
				
				<div class="detail-wrapper">
					<div class="detail-wrapper-header">
						<h4>Introduction</h4>
					</div>
					<div class="detail-wrapper-body">
						<p>{{ $user->usermeta->introduction ?? 'Not given' }}</p>
					</div>
				</div>
				
			</div>
			
			<!-- Sidebar -->
			<div class="col-md-4 col-sm-12">
				<div class="sidebar">
					
					<!-- Start: Opening hour -->
					<div class="widget-boxed lg mb-0">
						<div class="widget-boxed-body yellow-skin">
							@if(Session::has('success_message') || $wishlist == 1)
							<form action="{{ route('all.removeProfile',$user->id)  }}" method="post">
								@csrf
								@method('PUT')
								<button class="btn btn-m theme-btn full-width mrg-bot-10"><i class="fa fa-close"></i>&nbsp;&nbsp; Remove Profile</button>
							</form>
							@else
							<form action="{{ route('all.saveProfile',$user->id)  }}" method="post">
								@csrf
								<button class="btn btn-m theme-btn full-width mrg-bot-10"><i class="fa fa-heart"></i>&nbsp;&nbsp; Save Profile</button>
							</form>
							@endif
						</div>
					</div>
					<!-- End: Opening hour -->
					<div class="widget-boxed">
						<div class="widget-boxed-header">
							<h4><i class="ti-location-pin padd-r-10"></i>Contact Details</h4>
						</div>
						<div class="widget-boxed-body">
							<div class="side-list no-border">
								<ul>
									@if($detailInfo == 1)
									<li><a href="tel:{{ $user->contact }}"><i class="ti-mobile padd-r-10"></i>{{ $user->contact }}</a></li>
									<li><a href="mailto:{{ $user->email }}"><i class="ti-email padd-r-10"></i>{{ $user->email }}</a></li>
									<li><i class="ti-location-pin padd-r-10"></i>
										{{ $user->usermeta->location }},
										{{ $user->usermeta->city }},
										{{ $user->usermeta->state }}
									</li>
									
									@if($user->role == 3)
										<li><i class="ti-shield padd-r-10"></i>{{ substr($user->usermeta->experience,0,1) }} - {{ substr($user->usermeta->experience, 1 , 3) }}   Years Experience</li>
									@endif
									@else
									<li>
										<div class="alert alert-danger">
											<i class="ti-warning padd-r-10"></i>
											Buy a plan to view contact details.
										</div>
									</li>
									<li><a href="{{ URL::to('/pricing') }}" class="btn btn-m theme-btn full-width mrg-bot-10">Buy a Plan</a>
								</li>
								@endif
							</ul>
						</div>
					</div>
					<div class="widget-boxed-header">
						<h4><i class="ti-share padd-r-10"></i>Share Profile</h4>
					</div>
					<div class="widget-boxed-body">
						<ul class="side-list-inline no-border social-side">
							<li><a target="_blank" href="http://www.facebook.com/share.php?u={{ url()->current() }}"><i class="fa fa-facebook theme-cl"></i></a></li>
							<li><a target="_blank" href="https://twitter.com/share?url={{ url()->current() }}"><i class="fa fa-twitter theme-cl"></i></a></li>
							<li><a target="_blank" href="mailto:?subject=Macro Investors&body={{ url()->current() }}"><i class="fa fa-envelope theme-cl"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
		
	</div>
	<!-- End Row -->
	
	<!-- row -->
	@if(count($relatedUser) > 0)
	<div class="row">
		<div class="col-md-12">
			<h4 class="mrg-bot-20">Similar Profiles</h4>
		</div>
	</div>
	<!-- End Row -->
	<!-- row -->
	<div class="row">
		
		<!-- Single Employee List -->
		@foreach($relatedUser as $relUser)
		<div class="col-md-3 col-sm-6">
			<div class="contact-box">
				<div class="contact-img">
					<img src="{{ asset('media/'.$relUser->picture) }}" class="profilepic img-circle img-responsive" alt="">
				</div>
				<div class="contact-caption">
					<h4 class="font-16 font-midium">{{$relUser->name}}</h4>
					@if(!empty($relUser->maxinvestment))
					<span>Max: <strong>Rs.{{$relUser->maxinvestment}}</strong></span>
					@endif
				</div>
				<div class="contact-footer">
					<!-- <a href="#" class="col-half"><span class="con-message"><i class="ti-email"></i>Message</span></a> -->
					<a href="{{ route('all.profile', $relUser->user_id) }}" class="left-br col-half">
						<span class="con-profile"><i class="ti-eye"></i>Quick View</span>
					</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	@endif
	<!-- End Row -->
	
</div>
</section>

<!-- ====================== End Resume Detail ================ -->

@endsection
@section('js')
<script>
	
</script>
@endsection
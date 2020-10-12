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
					<form action="" method="get" accept-charset="utf-8">
					<div class="widget-boxed-header">
						<h4>Location</h4>
					</div>
					<div class="widget-boxed-body map-searches">
						<div class="">
							<input type="text" class="form-control mb-0" value="{{ request()->l ? request()->l : '' }}" id="location" placeholder="Location" name="l" autocomplete="" onkeypress="return event.keyCode!=13" />
							<input type="hidden" value="{{ request()->l ? request()->lat : '' }}" name="lat" id="lat" />
							<input type="hidden" value="{{ request()->l ? request()->long : '' }}" name="long" id="long" />
						</div>
					</div>
				
					<div class="widget-boxed-header">
						<h4>Investor Type</h4>
					</div>
					<div class="widget-boxed-body">
						<div class="side-list no-border">
							<ul>
								<li>
									<span class="custom-radio">
										<input type="radio" id="1" name="type" value="sleeping"
										{{request()->type == 'sleeping' ? 'checked' : ''}}>
										<label for="1"></label>
									</span>
									Sleeping Partner
								</li>
								<li>
									<span class="custom-radio">
										<input type="radio" id="2" name="type" value="working"
										{{request()->type == 'working' ? 'checked' : ''}}>
										<label for="2"></label>
									</span>
									Working Partner
								</li>
								
							</ul>
						</div>
					</div>
				<div class="d-flex flex-wrap justify-content-between align-items-center sidebarSubmit">
				<input type="submit" value="Search" class="btn theme-btn btn-m"/>
				<a class="btn btn-secondary btn-m" href="{{URL::to('/investors')}}">Clear</a>
				</div>
				</form>
				</div>
			</div>
			
			<!-- Start Job List -->
			<div class="col-md-9 col-sm-12">
				
				
				<div class="row">
					<!-- Single Employee List -->

					@if(count($users))

						@foreach($users as $user)
						<div class="col-md-4 col-sm-6">
							<div class="contact-box">
								<div class="contact-img">

									@if($user->picture == '')
									 	<img src="{{ asset('media/'.'user.png') }}" class="profilepic img-circle img-responsive" alt="">
									@else
										<img src="{{ asset('media/'.$user->picture)}}" class="profilepic img-circle img-responsive" alt="">
									@endif

								</div>
								<div class="contact-caption">
									<h4 class="font-16 font-midium">{{$user->name}}</h4>
										<span class="min24">{{ $user->profile }}</span>
								</div>
								<div class="contact-footer">
									<a href="{{ route('all.profile', $user->id) }}" class="left-br col-half">
										<span class="con-profile"><i class="ti-eye"></i>Quick View</span>
									</a>
									<a href="{{ route('chatinvite', $user->user_id) }}" class="left-br col-half">
										<span class="con-profile"><i class="ti-comment-alt"></i>Chat</span>
									</a>
								</div>
							</div>
						</div>
						@endforeach
					@else
					<h3 class="text-center notFound">No Result Found!</h3>
					@endif
				</div>
				
				@if(count($users))
					<div class="row">
						<div class="col-md-12 mrg-top-20">
							<div class="text-center">
							</div>
						</div>
					</div>
				@endif
			</div>
			
		</div>
		<!-- End Row -->
		
	</div>
</section>

<!-- ====================== End Job Detail 2 ================ -->

@endsection

@section('js')

@include ('login/addressApi');

<script>
	@if( request()->get('location'))
		var floc = "{{request()->get('location')}}";
		var floc = floc.toLowerCase();
		$('[name=location] option').each(function(){
			if($(this).text().toLowerCase().indexOf(floc) != -1){
				$('[name=location]').val($(this).val());
			}
		});
	@endif
</script>
@endsection
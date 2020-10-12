@extends('layouts.app')

@section('content')

<div class="page-title light">
	<div class="container">
		<div class="page-caption">
			<h2>Service Providers</h2>
			<p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Service Providers</p>
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
				<form action="{{URL::to('/serviceproviders')}}" method="get" id="locationForm" accept-charset="utf-8">
				<div class="widget-boxed padd-bot-0 lg zx100">
					<div class="widget-boxed-header">
						<h4>Location</h4>
					</div>
					<div class="widget-boxed-body map-searches">
						<div class="">

							<input type="text" class="form-control" value="{{ request()->l ? request()->l : '' }}" id="location" placeholder="Location" name="l" autocomplete="" />
							<input type="hidden" value="{{ request()->l ? request()->lat : '' }}" name="lat" id="lat" />
							<input type="hidden" value="{{ request()->l ? request()->long : '' }}" name="long" id="long" />
						</div>
					</div>
					<div class="widget-boxed-header">
						<h4>Preference</h4>
					</div>
					<div class="widget-boxed-body map-searches">
						<div class="">
								<select name="type" class="form-control mapicon">
									<option value="">Company or Freelancer</option>
									<option value="company" {{ request()->type == 'company' ? 'selected' : ''}}>Company</option>	
									<option value="freelancer" {{ request()->type == 'freelancer' ? 'selected' : ''}}>Freelancer</option>	
								</select>
						</div>
					</div>
				
					<div class="widget-boxed-header br-0">
						<h4>Experience <a href="#experince"></a></h4>
					</div>
					<div class="widget-boxed-body" id="experince">
						<div class="side-list no-border">
							<ul>
								<li>
									<span class="custom-radio">
										<input type="radio" id="11" name="e" value="-1">
										<label for="11"></label>
									</span>
									Less than 1 Year
								</li>
								<li>
									<span class="custom-radio">
										<input type="radio" id="21" name="e" value="12">
										<label for="21"></label>
									</span>
									1 Year To 2 Year
								</li>
								<li>
									<span class="custom-radio">
										<input type="radio" id="31" name="e" value="23">
										<label for="31"></label>
									</span>
									2 Year To 3 Year
								</li>
								<li>
									<span class="custom-radio">
										<input type="radio" id="41" name="e" value="34">
										<label for="41"></label>
									</span>
									3 Year To 4 Year
								</li>
								<li>
									<span class="custom-radio">
										<input type="radio" id="51" name="e" value="45">
										<label for="51"></label>
									</span>
									4 Year To 5 Year
								</li>
								<li>
									<span class="custom-radio">
										<input type="radio" id="61" name="e" value="50">
										<label for="61"></label>
									</span>
									5+ Year
								</li>
							</ul>

						</div>
					</div>
					<div class="d-flex flex-wrap justify-content-between align-items-center sidebarSubmit">
						<input type="submit" value="Search" class="btn theme-btn btn-m"/>
						<a class="btn btn-secondary btn-m" href="{{URL::to('/serviceproviders')}}">Clear</a>
					</div>

				</form>
				</div>
			</div>
			
			<!-- Start Job List -->
			<div class="col-md-9 col-sm-12">
				
				
				<div class="row">
					<!-- Single Employee List -->
					@if(count($userId) > 0)
						@foreach($userId as $user)
						<div class="col-md-4 col-sm-6">
							<div class="contact-box">
								<div class="contact-img">
									@if(isset($user->picture))
                                    <img src="{{ asset('media/'.$user->picture) }}" class="profilepic img-circle img-responsive" alt="">
                                @else
								 	<img src="{{ asset('media/'.'user.png') }}" class="profilepic img-circle img-responsive" alt="">
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
									<a href="{{ route('chatinvite', $user->id) }}" class="left-br col-half">
										<span class="con-profile"><i class="ti-comment-alt"></i>Chat</span>
									</a>
								</div>
							</div>
						</div>
						@endforeach
					@else
					<h3 class="text-center notFound">No Result Found!</h3>
					<div class="text-center">
						@if(isset($_GET['lat']))
						<br>
						<a class="btn theme-btn btn-m" href="{{URL::to('/serviceproviders')}}">Clear Filters</a>
						@endif
					</div>
					

					@endif
				</div>
 

		        <div class="paginationBlock">
		            {{-- {!! $userId->render() !!} --}}
		        </div>

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
	$(function(){
		@if( request()->e && request()->e != '')
			var exp = {{request()->get('e')}};
			$('[name=e][value='+exp+']').prop('checked',true);
		@endif
	});
</script>
@endsection
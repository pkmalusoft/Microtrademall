@extends('layouts.app')



@section('content')



<div class="page-title light" style="background:url(assets/img/banner-4.jpg);">

	<div class="container">

		<div class="page-caption">

			<h2>Browse Franchisers</h2>

			<p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Browse Franchisers</p>

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

				
				<form action="{{route('filterFranchisee.seeker')}}" method="Post" id="locationForm" accept-charset="utf-8">

					@csrf
				<div class="widget-boxed  zx100">

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

				</div>

			
				<div class="widget-boxed padd-bot-0">



					<div class="widget-boxed-header">



						<h4>Business Type</h4>



					</div>



					<div class="widget-boxed-body">



						<div class="side-list no-border">



							<ul>

								

								@foreach($businessList as $key=>$business)



								<li>



									<span class="custom-checkbox">



										<input type="checkbox" id="{{$key}}" name="businessType[]" value="{{$business->businessType}}">



										<label for="{{$key}}"></label>



									</span>



									{{$business->businessType}}



								</li>



								@endforeach



								<input type="hidden" name="lookingfor" value="franchiser">



								



							</ul>



						</div>



					</div>



				</div>

				
				<div class="d-flex flex-wrap justify-content-between align-items-center sidebarSubmit">
					<input type="submit" value="Search" name="submit" class="btn theme-btn btn-m"/>
					<a class="btn btn-secondary btn-m" href="{{URL::to('/franchisers')}}">Clear</a>
				</div>
				

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
									@if($user->user)
									<h4 class="font-16 font-midium">{{$user->user->name}}</h4>

									@endif

										<span>Business : <strong>{{$user->businessType}}</strong></span>

								</div>


								<div class="contact-footer">
									<a href="{{ route('all.profile', $user->user->id) }}" class="left-br col-half">
										<span class="con-profile"><i class="ti-eye"></i>Quick View</span>
									</a>
									<a href="{{ route('chatinvite', $user->user->id) }}" class="left-br col-half">
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
	@if( request()->businessType)

		var businessType= {!! json_encode(request()->businessType) !!};
		$('[name="businessType[]"').each(function(){
			if(businessType.indexOf($(this).val()) != -1){
				$(this).prop('checked',true);
			}
		});
	@endif
	});
</script>
@endsection



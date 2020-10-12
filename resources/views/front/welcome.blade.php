@extends('layouts.app')



@section('content')

    <!-- ======================= Start Banner ===================== -->

		<div class="main-banner" style="background-image:url({{asset('assets/img/investor-investment-service-provider.jpg')}});" data-overlay="7">

			<div class="container">
				<div class="row">
				<div class="col-md-6 col-sm-12">

					<div class="caption cl-white">

						<h2>Find <span>Investors & Partners</span><br> <span>Loans  & Business Services</span><br/> for your Business.</h2>
						<p>A unique platform for small business to interact with loan providers, Franchises, 
						Investors, Partners  and various business service providers.</p>
					</div>

					<form action="" method="post">

						@csrf

						<fieldset class="home-form-1">


							<div class="col-md-6 col-sm-6 padd-0 searchFeld form-group">

								<select class="wide form-control br-1" name="lookingfor" required="">

									<option data-display="Looking For" value="">Looking For</option>

									<option value="investors">Investor</option>

									<option value="serviceproviders">Service Provider</option>

									{{-- <option value="investees">Investee</option> --}}

								</select>

							</div>

								

							<div class="col-md-6 col-sm-6 padd-0 searchFeld form-group">


								<input  class="wide form-control br-1" type="text" name="location" id="location" placeholder="Location" />

								<input type="hidden" id="lat" name="lat" />
                                <input type="hidden" id="long" name="long" />
							</div>

								
							<div class="col-md-12 col-sm-12 padd-0 m-clear searchFeld">

								<button type="submit" class="btn theme-btn cl-white seub-btn">SEARCH NOW</button>

							</div>
							</div>
						</fieldset>

					</form>

					
				</div>
				<div class="supportBtn">
					<a href="{{route('support')}}"><i class="ti-settings"></i>FAQ</a>
				</div>
			</div>
			</div>

		</div>

		<!-- ======================= End Banner ===================== -->

		

		<!-- ====================== How It Work ================= -->

		<section class="how-it-works">

			<div class="container">

				

				<div class="row" data-aos="fade-up">

					<div class="col-md-12">

						<div class="heading">

							<h2>Choose your  <span class="theme-cl">REQUIREMENT</span></h2>

							<p>There are a lot of people who is searching for Investors, Investments, Partners, Loans and Business services.<br> We are providing all these services under one roof.</p>

						</div>

					</div>

				</div>

				

				<div class="row">

					

					<!-- Single opening -->

					<div class="col-lg-3 col-md-4 col-sm-6">

						<div class="employer-widget">

							<div class="u-content">

								<div class="avatar box-80">

									<a href="{{route('frontInvestor')}}"><img class="img-responsive" src="{{asset('assets/img/investment.png')}}" alt="">

								</div>

								<h3>I need Investors</h3>

								<p class="text-muted">Anyone who is looking for Investors </p>

								</a>

							</div>

							<div class="job-type-grid">

								<a href="{{route('frontInvestor')}}" class="employer-browse-btn btn-warning br-light">View More</a>



							</div>

						</div>

					</div>

					

					<!-- Single opening -->

					<div class="col-lg-3 col-md-4 col-sm-6">

						<div class="employer-widget">

							<div class="u-content">

								<div class="avatar box-80">

									<a href="{{route('loanProviders')}}"><img class="img-responsive" src="{{asset('assets/img/loan-seeker.png')}}" alt="">

								</div>

								<h3>I need Loan</h3>

									<p class="text-muted">Anyone who is looking for loan </p>
								</a>
							</div>

							<div class="job-type-grid">

								<a href="{{route('loanProviders')}}" class="employer-browse-btn btn-warning br-light">View More</a>

							</div>

						</div>

					</div>

					

					<!-- Single opening -->

					<div class="col-lg-3 col-md-4 col-sm-6">

						<div class="employer-widget">

							<div class="u-content">

								<div class="avatar box-80">

									<a href="{{route('frontInvestee')}}"><img class="img-responsive" src="{{asset('assets/img/investor.png')}}" alt="">

								</div>

								<h3>I want to Invest</h3>

								<p class="text-muted">Anyone who is interested to invest in any business or willing to be a partner</p></a>

							</div>

							<div class="job-type-grid">

								<a href="{{route('frontInvestee')}}" class="employer-browse-btn btn-warning br-light"> View More</a>

							</div>

						</div>

					</div>

					

					<!-- Single opening -->

					<div class="col-lg-3 col-md-4 col-sm-6">

						<div class="employer-widget">

							<div class="u-content">

								<div class="avatar box-80">

									<a href="{{route('all.Service')}}"><img class="img-responsive" src="{{asset('assets/img/team.png')}}" alt="">

								</div>

								<h3>I need Business service</h3>

								<p class="text-muted">Anyone who is looking for freelancers</p>

							</a>

							</div>

							<div class="job-type-grid">

								<a href="{{route('all.Service')}}" class="employer-browse-btn btn-warning br-light">View More</a>

							</div>

						</div>

					</div>

					

					<!-- Single opening -->

					<div class="col-lg-3 col-md-4 col-sm-6">

						<div class="employer-widget">

							<div class="u-content">

								<div class="avatar box-80">

									<a href={{route('all.franchisers')}}><img class="img-responsive" src="{{asset('assets/img/franchise.png')}}" alt="">

								</div>

								<h3>I am looking  for a Franchisee</h3>

								<p class="text-muted">Anyone  looking for Franchise </p></a>

							</div>

							<div class="job-type-grid">

								<a href="{{route('all.franchisers')}}" class="employer-browse-btn btn-warning br-light">View More</a>

							</div>

						</div>

					</div>

					

					<!-- Single opening -->

					<div class="col-lg-3 col-md-4 col-sm-6">

						<div class="employer-widget">

							<div class="u-content">

								<div class="avatar box-80">

									<a href="{{route('all.loanSeekers')}}"><img class="img-responsive" src="{{asset('assets/img/loan-provider.png')}}" alt="">

								</div>

								<h3>I Want to Provide  Loan</h3>

								<p class="text-muted">Anyone  interested in providing Loans</p></a>

							</div>

							<div class="job-type-grid">

								<a href="{{route('all.loanSeekers')}}" class="employer-browse-btn btn-warning br-light">View More</a>

							</div>

						</div>

					</div>

					

					<!-- Single opening -->

					<div class="col-lg-3 col-md-4 col-sm-6">

						<div class="employer-widget">

							<div class="u-content">

								<div class="avatar box-80">

									<a href="employer-detail.html"><img class="img-responsive" src="{{asset('assets/img/fund.png')}}" alt=""></a>

								</div>

								<h3><a href="{{url('/service/15')}}">I am Investment Consultant (personal)</h3>

								<ul class="InvestmentList">

								    <li>Mutual Fund </li>

								    <li>SIP </li>

								    <li> Shares</li>

								</ul>

								<p class="text-muted">Anyone who wish to market investment products</p>
								</a>
							</div>

							<div class="job-type-grid">

								<a href="{{url('/service/15')}}" class="employer-browse-btn btn-warning br-light">View More</a>

							</div>

						</div>

					</div>

					

					<!-- Single opening -->

					<div class="col-lg-3 col-md-4 col-sm-6">

						<div class="employer-widget">

							<div class="u-content">

								<div class="avatar box-80">

									<a href="{{route('all.franchiseeSeeker')}}"><img class="img-responsive" src="{{asset('assets/img/c-8.png')}}" alt="">

								</div>

								<h5>I want to provide Franchisee</h5>

								<p class="text-muted">Anyone looking for a Franchise business</p></a>

							</div>

							<div class="job-type-grid">

								<a href="{{route('all.franchiseeSeeker')}}" class="employer-browse-btn btn-warning br-light">View More</a>

							</div>

						</div>

					</div>

					

				</div>

				

				<!--<div class="col-md-12 mrg-top-40">

					<div class="text-center">

						<a href="#" class="btn theme-btn btn-m">Browse Popupar Company</a>

					</div>

				</div>-->

				

			</div>

		</section>

		

		<!-- ================= Category start ========================= -->

		<section class="image-bg" style="background:url({{asset('assets/img/business-service-webdesigner-investment.jpg')}}) no-repeat;" data-overlay="7">

			<div class="container">

			

				<div class="row" data-aos="fade-up">

					<div class="col-md-12">

						<div class="heading light">

							<h2>Business Service</h2>

							<p>Select from a wide variety of business such as Accountant, Auditors, Document Processing<br>Tax consultants, PRO's etc...</p>

						</div>

					</div>

				</div>

				

				<div class="row">

						

					@if(count($services))

						@foreach($services as $key => $svc)

							<div class="col-md-3 col-sm-6">
								<a href="{{ URL::to('/service/'.$svc->id) }}">
									<div class="category-box" data-aos="fade-up">
										<div class="category-desc">
											<div class="category-icon">
												@if($svc->icon)
												<img src="{{asset('media/'.$svc->icon)}}" alt="" style="width:55px">
												
												@else
												<img src="{{asset('media/serviceIcon.png')}}" alt="" style="width:55px">
												@endif
											</div>
											<div class="category-detail category-desc-text">
												<h3>{{ $svc->title }}</h3>
											</div>
										</div>
									</div>
								</a>

							</div>
							@if($key == 7)
								@break
							@endif


						@endforeach

					@endif 
					

					<div class="col-md-12 mrg-top-40">

						<div class="text-center">

							<!-- <a href="#" class="btn theme-btn btn-m">Browse All Category</a> -->

						</div>

					</div>

					

				</div>

				

			</div>

		</section>

		



		<!-- ================= Job start ========================= -->

		<section>

			<div class="container">

  

				<!-- Nav tabs -->

				<ul class="nav nav-tabs nav-advance FeaturedBlock" role="tablist">

					<li class="nav-item active">

						<a class="nav-link" data-toggle="tab" href="#recent" role="tab">

						Featured Investors</a>

					</li>

					<li class="nav-item">

						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">

						Featured Investees</a>

					</li>

					<li class="nav-item">

						<a class="nav-link" data-toggle="tab" href="#providers" role="tab">

						Featured Service Providers</a>

					</li>

					

				</ul>

				

				<div class="tab-content">

					

					<!-- Recent Job -->

					<div class="tab-pane fade in show active" id="recent" role="tabpanel">

						<div class="row">
							<!-- Single Investor -->
							@if($investors != null)
							@foreach($investors as $inv)
							<div class="col-md-6 col-sm-12">
								<!-- Single Verticle job -->
								<div class="job-verticle-list">
									<span class="urgent">Featured</span>
									<div class="vertical-job-card">
										<div class="vertical-job-header">
											<div class="vrt-job-cmp-logo">
												<a href="{{ url('/profile',$inv->id) }}">
													@if($inv->picture)
					                                    <img src="{{asset('media/'.$inv->picture)}}" width="50" class="img-circle img-responsive" style="height: 50px;object-fit: cover;object-position: top;">
					                                @else
					                                <i class="ti-user fa-4x"></i>
					                                @endif
												</a>
											</div>
											<h4><a href="{{ url('/profile',$inv->id) }}">{{ $inv->name }}</a></h4>
											<span class="com-tagline">Max. Amount Rs.@if( $inv->usermeta)
												{{ $inv->usermeta->maxinvestment }} @endif</span>
										</div>
										<div class="vertical-job-body">
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<ul class="can-skils">
														<!-- <li><i class="fa fa-map-marker"></i> 2708 Scenic Way,  IL 62373</li>
														<li><i class="fa fa-credit-card"></i> $530 - 697</li> -->
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@endif 

						</div>
					</div>

					
					<!-- Featured Job -->
					<div class="tab-pane fade" id="featured" role="tabpanel">
						<div class="row">
							@if($investees != null)
							@foreach($investees as $inv)
							<div class="col-md-6 col-sm-12">
								<!-- Single Verticle job -->
								<div class="job-verticle-list">
									<span class="urgent">Featured</span>
									<div class="vertical-job-card">
										<div class="vertical-job-header">
											<div class="vrt-job-cmp-logo">
												<a href="{{ url('/profile',$inv->user_id) }}">
													@if($inv->picture)
					                                    <img src="{{asset('media/'.$inv->picture)}}" width="50" class="img-circle img-responsive" style="height: 50px;object-fit: cover;object-position: top;">
					                                @else
					                                <i class="ti-user fa-4x"></i>
					                                @endif
												</a>
											</div>
											<h4><a href="{{ url('/profile',$inv->user_id) }}">{{ $inv->name }}</a></h4>
											<!-- <span class="com-tagline"></span> -->
										</div>
										<div class="vertical-job-body">
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<ul class="can-skils">
														<!-- <li><i class="fa fa-map-marker"></i> 2708 Scenic Way,  IL 62373</li>
														<li><i class="fa fa-credit-card"></i> $530 - 697</li> -->
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@endif 

					</div>
				</div>


				<div class="tab-pane fade" id="providers" role="tabpanel">
						<div class="row">
							@if($providers != null)
							@foreach($providers as $inv)
							<div class="col-md-6 col-sm-12">
								<!-- Single Verticle job -->
								<div class="job-verticle-list">
									<span class="urgent">Featured</span>
									<div class="vertical-job-card">
										<div class="vertical-job-header">
											<div class="vrt-job-cmp-logo">
												<a href="{{ url('/profile',$inv->user_id) }}">
													@if($inv->picture)
					                                    <img src="{{asset('media/'.$inv->picture)}}" width="50" class="img-circle img-responsive" style="height: 50px;object-fit: cover;object-position: top;">
					                                @else
					                                <i class="ti-user fa-4x"></i>
					                                @endif
												</a>
											</div>
											<h4><a href="{{ url('/profile',$inv->user_id) }}">{{ $inv->name }}</a></h4>
											<!-- <span class="com-tagline"></span> -->
										</div>
										<div class="vertical-job-body">
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<ul class="can-skils">
														<!-- <li><i class="fa fa-map-marker"></i> 2708 Scenic Way,  IL 62373</li>
														<li><i class="fa fa-credit-card"></i> $530 - 697</li> -->
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@endif 

					</div>
				</div>


				

			</div>

            </div>

		</section>

		

		<!-- ======================= Our facts ========================== -->

		<section class="image-bg light-text" style="background:#0f75bc url({{asset('assets/img/pattern.png')}}) repeat;">

			<div class="container">

			

				<div class="row">

					<div class="col-md-12 text-center">

						<div class="heading light">

							<h2>What Our Members Says</h2>

							<p>An excellent platform for micro business</p>

						</div>

                        </div>

					</div>

				</div>

				

				<div class="row feedbackBlock">

				<div class="container">					

                    <div class="col-lg-6 col-md-6 feedbackCol">

					    <img src="{{asset('assets/img/avatar-3.jpg')}}" alt="">

						  <p>I was searching for a platform that provides buying and selling of business and i found 
						  this site matching my requirements.</p>

					</div>

					

					<div class="col-lg-6 col-md-6 feedbackCol">

					    <img src="{{asset('assets/img/avatar-2.jpg')}}" alt="" >

						  <p>To find reliable business service near to my location was always a difficult task.
						  When i saw the features in this site i understood this was what i was looking !.</p>

					</div>

				</div>

				</div>

		</section>

		

		<!-- ================= Blog start ========================= -->

		<section>

			<div class="container">

			

				<div class="row" data-aos="fade-up">

					<div class="col-md-12">

						<div class="heading">

							<h2>Our Blog</h2>

						<p>Enhance the knowledge in your field of activities by regularly reading our <br> blogs from experts.</p>
						</div>

					</div>

				</div>

				

				<div class="row">

					
		@foreach($blogs as $blog)

			<div class="col-md-4 col-sm-6">

				<div class="blog-box blog-grid-box">

					<div class="blog-grid-box-img">

						<img src="{{url('storage/app/public/'.$blog->image)}}" class="img-responsive" alt="" />

					</div>

					

					<div class="blog-grid-box-content">

						

						<h4>{{$blog->title}}</h4>
							@php 
							
							$content =substr($blog->description,0,200);

							@endphp

						<p>{!! $content !!}</p>

						<a href="{{route('blog', $blog->id)}}" class="theme-cl" title="Read More..">Continue...</a>

					</div>

					

				</div>

			</div>

			@endforeach


				</div>

				

			</div>

		</section>

		

		<!-- =================== Newsletter ==================== -->

		<section class="newsletter theme-bg" style="background-image:url({{asset('assets/img/bg-new.png')}})">

			<div class="container">

				

				<div class="row">

					<div class="col-md-10 col-md-offset-1">

						<div class="heading light text-center">

						<h2>Ready to Register</h2>

							<p>Register to use the full features of our platform</p>

							 <a href ="{{route('frontPricing')}}" class="btn theme-btn btn-radius btn-m">Register</a>

						</div>

						

					</div>

				</div>

				

				

			</div>

		</section>

		<!-- =================== End Newsletter ==================== -->

		

 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog homepopUp">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Important Information </h4>
        </div>
        <div class="modal-body">
          <p>We don't provide any loans. We only provide our platform for our members to interact with loan and other service providers.The members can either AVAIL or PROVIDE loan or services. We will not be responsible or liable for any payments done between members.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn theme-btn" data-dismiss="modal">Agree</button>
        </div>
      </div>
      
    </div>
  </div>

@endsection

@section('js')
	@include ('login/addressApi')

@if(!Session::has('popup')) 
<script>
$(document).ready(function() {
	 // var isshow = localStorage.getItem('status');
  //  	 if (isshow!= 1) {
	 //   	 	  localStorage.setItem('status', 1);
	   setTimeout(function() {
	    $('#myModal').modal();
	}, 2000);
  //}
});

</script>
@endif

@php
	Session::put('popup', 'set');
@endphp

@endsection
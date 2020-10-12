@extends('layouts.app')



@section('content')



<div class="page-title light" style="background:url(assets/img/banner-4.jpg);">

	<div class="container">

		<div class="page-caption">

			<h2>Browse Loan Providers</h2>

			<p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Browse Loan Providers</p>

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

				{{-- 

				<div class="widget-boxed padd-bot-0">

					<div class="widget-boxed-header">

						<h4>Investor Amount</h4>

					</div>

					<div class="widget-boxed-body">

						<div class="side-list no-border">

							<ul>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="a1">

										<label for="a1"></label>

									</span>

									Full Time

									<span class="pull-right">102</span>

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="b1">

										<label for="b1"></label>

									</span>

									Part Time

									<span class="pull-right">78</span>

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="c1">

										<label for="c1"></label>

									</span>

									Internship

									<span class="pull-right">12</span>

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="d1">

										<label for="d1"></label>

									</span>

									Freelancer

									<span class="pull-right">85</span>

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="e1">

										<label for="e1"></label>

									</span>

									Contract Base

									<span class="pull-right">307</span>

								</li>

							</ul>

						</div>

					</div>

				</div>

				

				<div class="widget-boxed padd-bot-0">

					<div class="widget-boxed-header br-0">

						<h4>Designation <a href="#designation" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>

					</div>

					<div class="widget-boxed-body collapse" id="designation">

						<div class="side-list no-border">

							<ul>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="a">

										<label for="a"></label>

									</span>

									Web Designer

									<span class="pull-right">102</span>

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="b">

										<label for="b"></label>

									</span>

									Php Developer

									<span class="pull-right">78</span>

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="c">

										<label for="c"></label>

									</span>

									Project Manager

									<span class="pull-right">12</span>

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="d">

										<label for="d"></label>

									</span>

									Human Resource

									<span class="pull-right">85</span>

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="e">

										<label for="e"></label>

									</span>

									CMS Developer

									<span class="pull-right">307</span>

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="f">

										<label for="f"></label>

									</span>

									App Developer

									<span class="pull-right">256</span>

								</li>

							</ul>

						</div>

					</div>

				</div>

				

				<div class="widget-boxed padd-bot-0">

					<div class="widget-boxed-header br-0">

						<h4>Experince <a href="#experince" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>

					</div>

					<div class="widget-boxed-body collapse" id="experince">

						<div class="side-list no-border">

							<ul>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="11">

										<label for="11"></label>

									</span>

									1Year To 2Year

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="21">

										<label for="21"></label>

									</span>

									2Year To 3Year

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="31">

										<label for="31"></label>

									</span>

									3Year To 4Year

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="41">

										<label for="41"></label>

									</span>

									4Year To 5Year

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="51">

										<label for="51"></label>

									</span>

									5Year To 7Year

								</li>

								<li>

									<span class="custom-checkbox">

										<input type="checkbox" id="61">

										<label for="61"></label>

									</span>

									7Year To 10Year

								</li>

							</ul>

						</div>

					</div>

				</div>

				 --}}

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

										<img src="{{ asset('media/'.$user->picture)}}" class="profilepic img-circle img-responsive" alt="">

								</div>

								<div class="contact-caption">

									<h4 class="font-16 font-midium">{{$user->user->name}}</h4>


								</div>

								<div class="contact-footer">

									<a href="#" class="col-half"><span class="con-message"><i class="ti-email"></i>Message</span></a>

									

									<a href="{{ route('all.profile', $user->user->id) }}" class="left-br col-half">

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

				

				@if(count($users))

					<div class="row">

						<div class="col-md-12 mrg-top-20">

							<div class="text-center">

								<button type="button" class="btn theme-btn btn-m">Load More...</button>

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
@extends('layouts.app')

@section('content')

<div class="page-title light" style="background:url(assets/img/banner-4.jpg);">
	<div class="container">
		<div class="page-caption">
			<h2>About Us</h2>
			<p><a href="/" title="Home">Home</a> <i class="ti-arrow-right"></i> About Us</p>
		</div>
	</div>
</div>
<!-- ======================= End Page Title ===================== -->

<!-- ====================== Start Job Detail 2 ================ -->
<section class="gray">
	<div class="container">
		
		<!-- row -->
		<div class="row">
			<div class="detail-wrapper">
				<div class="detail-wrapper-header">
					<h4>About Us</h4>
				</div>
				<div class="detail-wrapper-body">
					<div class="informativeText">
						 {!! $about[0]->about !!}
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->
		
	</div>
</section>

<!-- ====================== End Job Detail 2 ================ -->

@endsection
@extends('layouts.app')

@section('content')

<div class="page-title light" style="background:url(assets/img/banner-4.jpg);">
	<div class="container">
		<div class="page-caption">
			<h2>About Us</h2>
			<p><a href="/" title="Home">Home</a> <i class="ti-arrow-right"></i> Blog</p>
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
					{{-- @php
					dd($blog);
					@endphp --}}
					<h4>{{$blog[0]->title}}</h4>
				</div>
				<div class="detail-wrapper-body">
					<div class="informativeText">
						 {!! $blog[0]->description !!}
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->
		
	</div>
</section>

<!-- ====================== End Job Detail 2 ================ -->

@endsection
@extends('layouts.app')

@section('content')
<div class="wrapper">
	
	<section>
		<div class="container">
			<div class="error-page padd-top-30 padd-bot-30">
				<h1 class="mrg-top-15 mrg-bot-0 cl-danger font-250 font-bold">500</h1>
				<h2 class="mrg-top-10 mrg-bot-5 funky-font font-60">You Missed</h2>
				<p style="color:#000;">The page you are looking for doesn't exist </p>
				<a href="{{ URL::to('/') }}" style="background: #f21136;color: #fff;" class="btn theme-btn-trans mrg-top-20">Go To Home Page</a>
			</div>
		</div>
	</section>
	
</div>
@endsection
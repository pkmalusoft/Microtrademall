@extends('layouts.app')

@section('content')
<!-- ======================= Start Page Title ===================== -->


	<div class="page-title light" >
		<div class="container">
			<div class="page-caption">
				<h2>{{ $plan->title }} Plan</h2>
				<p>
					<a href="#" title="Home">Home</a>
					<i class="ti-arrow-right"></i> {{ $plan->title }}</p>
			</div>
		</div>
	</div>
<!-- ======================= End Page Title ===================== -->
		
<!-- ================ Pricing Table ======================= -->
		<section class="gray">
			<div class="container">
			
					<div class="col-md-4 col-sm-4">
						<div class="package-box">
							<div class="package-header">
								<i class="fa fa-cog" aria-hidden="true"></i>
								<h3>{{ $plan->title }}</h3>
							</div>
							<div class="package-price">
								<h2><sup>Rs. </sup>{{ $plan->price }}<sub>/{{ $plan->duration }} days</sub></h2>
							</div>
							<div class="package-info">
								<ul>
									@php
									$features = explode(',',$plan->services); 
									@endphp 
									@foreach($features as $feature)
										<li>{{ $feature }}</li>
									@endforeach
								</ul>
							</div>
							<a href="{{ URL::to('/buy-plan',$plan->id) }}" class="btn btn-package">Buy Now</a>
						</div>
					</div>
				
			</div>
		</section>
		<!-- ================ End Pricing Table ======================= -->
@endsection


@section('js')

<script>
    function padStart(str) {
        return ('0' + str).slice(-2)
    }
    function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        // $("#paymentDetail").removeAttr('style');
        // $('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        $('#paymentDate').text(
                padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
                );
        $.ajax({
            method: 'post',
            url: "{!!route('proceedPayment')!!}",
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                "razorpay_payment_id": transaction.razorpay_payment_id
            },
            complete: function (r) {
            	if(r.status == 200){
            		window.location.href = '{{url("/activeplan")}}';
            	} else{
            		alert('Payment Failed. Please try again');
            	}
            }
        })
    }
</script>
<script>
    var options = {
        key: "{{ env('RAZORPAY_KEY') }}",
        name: 'MicroInvestors',
        description: 'MicroInvestors Plans',
        image: "{{asset('assets/img/logo.png')}}",
        handler: demoSuccessHandler,
        amount: "{{ $plan->price * 100 }}" ,
        "modal": {
	        "ondismiss": function(){
	            window.location.href = "{{ URL::to('pricing') }}"
	        }
	    }
    }
    window.r = new Razorpay(options);
    r.open();
</script>
@endsection
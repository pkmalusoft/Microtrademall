@extends('layouts.user')

@section('content')
	 <div class="authRightBlock">
	 	@if(Session::has('plan_success'))
            <div class="alert alert-success">
                <span class="glyphicon glyphicon-ok"></span>
                {!! session('plan_success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(Session::has('error'))
	        <div class="alert alert-danger">
                <span class="glyphicon glyphicon-ok"></span>
                {!! session('error') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(Session::has('planinfo'))
	        <div class="alert alert-danger">
                <span class="glyphicon glyphicon-ok"></span>
                {!! session('planinfo') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <span class="pull-left">
                    <h4 class="mt-5 mb-5">My Plans</h4>
                </span>

				<div class="btn-group btn-group-sm pull-right" role="group">
					<a href="{{ url('/	pricing') }}" class="btn btn-success" title="Buy New Plan">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</a>
				</div>

            </div>
        </div>
    </div>	
    <div class="authRightBlock">
		@if(count($plan))
			<div class="activePlans">
				<div class="panel-body panel-body-with-table">
					<div class="table-responsive planTableBlock">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Started On</th>
									<th>Expiring on</th>
									<th>Plan Duration</th>
									<th align="right">Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach($plan as $key => $pl)
			                    <tr>
									<td>{{ Carbon\Carbon::parse($pl->start)->format('j M, Y') }}</td>
									<td>{{ Carbon\Carbon::parse($pl->end)->format('j M, Y') }}</td>
									<td>
										@if($pl->payment_id == 'FREE')
											expiring on 02 September 2020
										@else
										{{  $pl->plan_duration }} Days
										@endif
									</td>
									<td>
										{!! $key == 0 ? '<small class="label label-success">Active</small>'
										 : '<small class="label label-primary">Reserved</small>' !!}
									</td>
			                    </tr>
			                    @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		@else 
		<h4>No active plan </h4>
		@endif
		</h4>
    </div>	

@endsection

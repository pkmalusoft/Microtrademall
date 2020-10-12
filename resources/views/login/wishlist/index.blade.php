@extends('layouts.user')

@section('content')
	 <div class="authRightBlock">
	 	@if(Session::has('success'))
            <div class="alert alert-success">
                <span class="glyphicon glyphicon-ok"></span>
                {!! session('success') !!}
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
        @endif
        <div class="panel panel-default">
            <div class="panel-heading clearfix mb-0">
                <span class="pull-left">
                    <h4 class="mt-5 mb-5">My Wishlist</h4>
                </span>

            </div>
        </div>
    </div>	
    <div class="authRightBlock">
		@if(count($wishlist))
			<div class="activePlans">
				<div class="panel-body panel-body-with-table">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Name</th>
									<th align="right"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($wishlist as $key => $wish)
			                    <tr>
									<td>{{ $key + 1 }}</td>
									<td>{{ $wish->username }}</td>
				                    <td>
				                    	<form action="{{ route('all.removeProfile',$wish->userId)  }}" method="post">
										@csrf
										@method('PUT')
		                                    <div class="btn-group btn-group-xs pull-right" role="group">
		                                    	<a class="btn btn-info" href="{{ url('/profile',$wish->userId) }}" target="_blank">
		                                            <span class="ti-eye" ></span>
		                                        </a>

		                                        <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm(&quot;Click Ok to delete.&quot;)">
		                                            <span class="ti-trash" aria-hidden="true"></span>
		                                        </button>
		                                    </div>
		                                </form>
	                                
	                            	</td>
			                    </tr>
			                    @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		@else 
		<h4>Wishlist is empty </h4>
		@endif
		</h4>
    </div>	

@endsection

@extends('layouts.user')

@section('content')
     {{--  --}}
    <div class="authRightBlock">
        @if(Session::has('success_message'))
            <div class="alert alert-success">
                <span class="glyphicon glyphicon-ok"></span>
                {!! session('success_message') !!}

                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        @endif

        <div class="panel panel-default">

            <div class="panel-heading clearfix">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">Plans</h4>
                </div>

                <div class="btn-group btn-group-sm pull-right" role="group">
                    <a href="{{ route('plans.plan.create') }}" class="btn btn-success" title="Create New Plan">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </div>

            </div>
            
            @if(count($plans) == 0)
                <div class="panel-body text-center">
                    <h4>No Plans Available.</h4>
                </div>
            @else
            <div class="panel-body panel-body-with-table">
                <div class="table-responsive">

                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>Title</th>
                                {{-- <th>Services (separate with comma)</th> --}}
                                <th>Price</th>
                                <th>Duration (days)</th>
                                <th>Is Active</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($plans as $plan)
                            <tr>
                                <td>{{ $plan->title }}</td>
                                {{-- <td>{{ $plan->services }}</td> --}}
                                <td>{{ $plan->price }}</td>
                                <td>{{ $plan->duration }}</td>
                                <td>{{ ($plan->is_active) ? 'Yes' : 'No' }}</td>

                                <td>

                                    <div method="POST" action="" accept-charset="UTF-8">
                                    <input name="_method" value="DELETE" type="hidden">
                                    {{ csrf_field() }}

                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('plans.plan.show', $plan->id ) }}" class="btn btn-info" title="Show Plan">
                                                <span class="ti-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('plans.plan.edit', $plan->id ) }}" class="btn btn-primary" title="Edit Plan">
                                                <span class="ti-pencil" aria-hidden="true"></span>
                                            </a>

                                            {{-- <button type="submit" class="btn btn-danger" title="Delete Plan" onclick="return confirm(&quot;Click Ok to delete Plan.&quot;)">
                                                <span class="ti-trash" aria-hidden="true"></span>
                                            </button> --}}
                                        </div>

                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        <div class="panel-footer">
            {!! $plans->render() !!}
        </div>
        
        @endif
    </div>
    
    </div>
@endsection
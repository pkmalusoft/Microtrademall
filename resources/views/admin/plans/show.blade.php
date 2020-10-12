@extends('layouts.user')

@section('content')

    {{--  --}}
    <div class="authRightBlock">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">{{ isset($plan->title) ? $plan->title : 'Plan' }}</h4>
                </span>

                <div class="pull-right">

                    <div method="POST" action="" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('plans.plan.index') }}" class="btn btn-primary" title="Show All Plan">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                            </a>

                            <a href="{{ route('plans.plan.create') }}" class="btn btn-success" title="Create New Plan">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </a>
                            
                            <a href="{{ route('plans.plan.edit', $plan->id ) }}" class="btn btn-primary" title="Edit Plan">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>

                            {{-- <button type="submit" class="btn btn-danger" title="Delete Plan" onclick="return confirm(&quot;Click Ok to delete Plan.?&quot;)">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button> --}}
                        </div>
                    </div>

                </div>

            </div>

            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                        <tr><td>Title</td><td>{{ $plan->title }}</td></tr>
                        <tr><td>Services (separate with comma)</td><td>{{ $plan->services }}</td></tr>
                        <tr><td>Price</td><td>{{ $plan->price }}</td></tr>
                        <tr><td>Duration (days)</td><td>{{ $plan->duration }}</td></tr>
                        <tr><td>Is Active</td><td>{{ ($plan->is_active) ? 'Yes' : 'No' }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@extends('layouts.user')

@section('content')
 {{--  --}}
    <div class="authRightBlock">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create New Role</h4>
                </span>

                <div class="btn-group btn-group-sm pull-right" role="group">
                    <a href="{{ route('roles.role.index') }}" class="btn btn-primary" title="Show All Role">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                </div>

            </div>

            <div class="panel-body">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('roles.role.store') }}" accept-charset="UTF-8" id="create_role_form" name="create_role_form" class="form-horizontal row">
                {{ csrf_field() }}
                @include ('admin.roles.form', [
                                            'role' => null,
                                          ])

                    <div class="form-group mx-0">
                        <div class="col-md-12">
                            <input class="btn btn-primary" type="submit" value="Add">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection



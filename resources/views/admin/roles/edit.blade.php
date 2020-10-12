@extends('layouts.user')

@section('content')
    {{--  --}}
    <div class="authRightBlock">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($role->title) ? $role->title : 'Role' }}</h4>
                </div>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <a href="{{ route('roles.role.index') }}" class="btn btn-primary" title="Show All Role">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('roles.role.create') }}" class="btn btn-success" title="Create New Role">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </div>
            </div>

            <div class="panel-body row">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('roles.role.update', $role->id) }}" id="edit_role_form" name="edit_role_form" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('admin.roles.form', [
                                            'role' => $role,
                                          ])

                    <div class="form-group mx-0">
                        <div class="col-md-12">
                            <input class="btn btn-primary" type="submit" value="Update">
                        </div>
                    </div>
                </form>
            </div>
    </div>
    </div>

@endsection
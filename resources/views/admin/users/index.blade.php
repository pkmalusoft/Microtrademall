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
                    <h4 class="mt-5 mb-5">Users</h4>
                </div>
                <div class="pull-right">
                    <form action="" method="get" id="roleFilterForm" style="display: flex;">
                        @if(count($roles)> 0)
                        <input type="text" id="user-search" class="form-control" placeholder="Name" name="name" style="margin-right: 20px;" value="{{ isset($_GET['name']) ? $_GET['name'] : '' }}" />

                        <select name="role" class="form-control col-md-4 text-capitalize">
                        <option value="">Filter by role</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{isset($_GET['role']) && $_GET['role'] == $role->id ? 'selected' :''}}>{{$role->title}}</option>
                        @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary"
                            style="min-width: 50px!important;height: 50px;margin-left: 15px;font-size: 17px;border-radius: 50%;">
                            <span class="fa fa-search"></span>
                        </button>
                        @endif
                    </form>
                </div>


            </div>
            
            @if(count($users) == 0)
                <div class="panel-body text-center">
                    <h4>No Users Available.</h4>
                </div>
            @else
            <div class="panel-body panel-body-with-table">
                <div class="table-responsive">

                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>@sortablelink('name')</th>
                                <!-- <th>@sortablelink('username')</th> -->
                                <th>@sortablelink('email')</th>
                                <th>@sortablelink('role')</th>
                                <th>@sortablelink('verification')</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <!-- <td>{{ $user->username }}</td> -->
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->title }}</td>
                                <td>
                                    {!! $user->verification != '' ? '
                                    <span style="color:red;" class="fa fa-close"></span>' : '<span style="color:green;" class="fa fa-check"></span>'  !!}</td>
                                <!-- <td> -->

                                    <!-- <div method="POST" action="" accept-charset="UTF-8">
                                    <input name="_method" value="DELETE" type="hidden">
                                    {{ csrf_field() }}

                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="" class="btn btn-info" title="Show User">
                                                <span class="ti-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="" class="btn btn-primary" title="Edit User">
                                                <span class="ti-pencil" aria-hidden="true"></span>
                                            </a>

                                            {{-- <button type="submit" class="btn btn-danger" title="Delete Plan" onclick="return confirm(&quot;Click Ok to delete Plan.&quot;)">
                                                <span class="ti-trash" aria-hidden="true"></span>
                                            </button> --}}
                                        </div> 

                                        </div> -->
                                    
                                <!-- </td> -->
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        
        @endif
    </div>
    
    </div>
@endsection
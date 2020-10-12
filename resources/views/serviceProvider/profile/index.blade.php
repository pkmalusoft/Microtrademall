@extends('layouts.user')

@section('content')
 {{--  --}}
    <div class="authRightBlock">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Edit Profile</h4>
                </span>
            </div>
           
            <div class="panel-body">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if(Session::has('success_message'))
		            <div class="alert alert-success">
		                <span class="glyphicon glyphicon-ok"></span>
		                {!! session('success_message') !!}

		                <button type="button" class="close" data-dismiss="alert" aria-label="close">
		                    <span aria-hidden="true">&times;</span>
		                </button>

		            </div>
		        @endif

                <form method="POST" action="{{ route('serviceprovider.updateprofile') }}" accept-charset="UTF-8" id="editProfileform" name="editProfileform" class="form-horizontal"  enctype="multipart/form-data">
                {{ csrf_field() }}
                	<div class="row">
                        <div class="col-md-6">
                            <div class="form-group mx-0">
                                <label>{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',Auth::user()->name) }}" required autocomplete="name" placeholder="Your Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mx-0">
                                <label>{{ __('Profile Tagline') }}</label>
                                <input id="profile" type="text" class="form-control @error('profile') is-invalid @enderror" name="profile" value="{{ old('profile',$meta->profile ?? '') }}" required autocomplete="profile" placeholder="Profile Tagline">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                                <label>{{ __('Profile Picture') }}</label>
                                <div class="custom-file-upload">
                                    <input type="file" id="file" name="picture" accept="image/*" />
                                </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mx-0">
                                <label>Experience</label>
                                <select name="experience"  class="form-control">
                                    <option value="">Choose Experience</option>
                                    <option value="-1"{{ $meta->experience == -1 ? 'selected' : '' }}>Less than 1 Year</option>
                                    <option value="12"{{ $meta->experience == 12 ? 'selected' : '' }}>1-2 Year</option>
                                    <option value="23"{{ $meta->experience == 23 ? 'selected' : '' }}>2-3 Year</option>
                                    <option value="34"{{ $meta->experience == 34 ? 'selected' : '' }}>3-4 Year</option>
                                    <option value="45"{{ $meta->experience == 45 ? 'selected' : '' }}>4-5 Year</option>
                                    <option value="50"{{ $meta->experience == 50 ? 'selected' : '' }}>5+ Year</option>
                                </select>
                            </div>
                          
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mx-0">
                                 <label>Your Location</label>
                                 <input id="location" id="location" type="text" class="form-control @error('location') is-invalid @enderror @error('long') is-invalid @enderror" name="location"  autocomplete="location" placeholder="Location" value="{{old('location',$meta->location)}}">
                                 <input type="hidden" id="lat" name="lat" value="{{old('lat',$meta->lat)}}"/>
                                 <input type="hidden" id="long" name="long" value="{{old('long',$meta->lng)}}"/>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group mx-0">
                                <label>City</label>
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"  autocomplete="city" placeholder="City" value="{{old('city',$meta->city)}}">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                            <div class="col-md-6" style="max-width: 300px;">
                            <div class="form-group mx-0">
                                <label>JobType</label>
                                <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <span class="custom-radio">
                                        <input type="radio" name="jobtype" value ="company" id="11" 
                                        {{ $meta->jobtype == 'company' ? 'checked' : ''}}>
                                        <label for="11"> </label>
                                        Company
                                    </span>
                                   
                                </li>
                                <li>
                                    <span class="custom-radio">
                                        <input type="radio" id="21" value ="freelancer" name="jobtype"
                                        {{ $meta->jobtype == 'freelancer' ? 'checked' : ''}}>
                                        <label for="21"></label>
                                    </span>
                                    Freelancer
                                </li>
                                 
                            </ul>
                            
                            </div>
                        </div>
                        


                    </div>

                    <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group mx-0">
                            <label>Services</label>
                            @if(isset($services))
                            <div class="row">
                                @foreach($services as $srv)
                                 <div class="checkboxes col-md-4">
                                    <span class="custom-checkbox">
                                            <input type="checkbox" id="service{{$srv->id}}" name="services[]" value="{{$srv->id}}">
                                        <label for="service{{$srv->id}}" ></label>
                                    </span>
                                    {{$srv->title}}
                                </div>
                                @endforeach
                            @endif
                            </div>
                            @error('services')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    </div>


                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group mx-0">
                                <label>Skills <small>( Each in seprate line )</small></label>
                                <textarea name="skills" placeholder="Skills"  class="largeTxtarea form-control @error('skills') is-invalid @enderror">{!! old('skills',$meta->skills) !!}</textarea>
                                
                                 @error('skills')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group mx-0">
                                <label>Introduction</label>
                                <textarea name="introduction" placeholder="Introduction"  class="largeTxtarea form-control @error('introduction') is-invalid @enderror">{{old('introduction',$meta->introduction)}}</textarea>
                                
                                 @error('introduction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mx-0">
                                <label>New Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="New Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mx-0">
                                <label>Confirm  Password</label>
                                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>
                    </div>


                    <div class="form-group mx-0">
                        <div class="col-md-12">
                            <input class="btn btn-primary" type="submit" value="Update">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


@endsection

@section('js')

@include ('login/addressApi');


<script>
    $('[name=investTypes]').val("");
    @if($meta->services != '')
    var services = {!! $meta->services !!};
    $('[name="services[]"]').each(function(){
        if(services.indexOf($(this).val()) != -1){
            $(this).attr('checked',true);
        }
    });
    @endif
</script>
@endsection
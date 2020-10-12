@extends('layouts.user')
@section('content')
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
         <form method="POST" action="{{ route('user.updateprofile') }}" accept-charset="UTF-8" id="editProfileform" name="editProfileform" class="form-horizontal" 
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group mx-0">
                     <label>{{ __('Name') }}</label>
                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',Auth::user()->name) }}" required autocomplete="name" placeholder="Your Name" autofocus>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="col-md-2 form-group mx-0">
                     <label></label>
                     @if($meta->picture)
                     <img src="{{asset('media/'.$meta->picture)}}" width="50" class="img-circle img-responsive" style="max-height: 50px;object-fit: cover;object-position: top;">
                     @else
                     <i class="ti-user fa-4x"></i>
                     @endif
                  </div>
                  <div class="col-md-10 form-group mx-0">
                     <label>{{ __('Profile Picture') }}</label>
                     <div class="custom-file-upload">
                        <input type="file" id="file" name="picture" accept="image/*" />
                     </div>
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
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group mx-0">
                     <label>Business Industry</label>
                     <input id="industry" type="text" class="form-control @error('businessindustry') is-invalid @enderror" name="businessType"  autocomplete="businessindustry" placeholder="Buinsess Industry" value="{{old('businessType',$meta->businessType)}}">
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
                     <label>Do you want to provide Franchise</label>
                     <ul class="list-unstyled d-flex flex-wrap">
                        <li class="col-lg-6">
                           <span class="custom-radio">
                           <input type="radio" name="franchiser" value ="1" id="10" checked>
                           <label for="10"> </label>
                           Yes
                           </span>
                        </li>
                        <li class="col-lg-6">
                           <span class="custom-radio">
                           <input type="radio" id="12" value ="0" name="franchiser">
                           <label for="12"></label>
                           </span>
                           No
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group mx-0">
                     <label>I need Investment</label>
                     <ul class="list-unstyled d-flex flex-wrap">
                        <li class="col-lg-6">
                           <span class="custom-radio">
                           <input type="radio" name="lookingForInvestment" value ="1" id="8" checked>
                           <label for="8"> </label>
                           Yes
                           </span>
                        </li>
                        <li class="col-lg-6">
                           <span class="custom-radio">
                           <input type="radio" id="9" value ="0" name="lookingForInvestment">
                           <label for="9"></label>
                           </span>
                           No
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group mx-0">
                     <label>I need Loan</label>
                     <ul class="list-unstyled d-flex flex-wrap">
                        <li class="col-lg-6">
                           <span class="custom-radio">
                           <input type="radio" name="lookingForLoan" value ="1" id="5" checked>
                           <label for="5"> </label>
                           Yes
                           </span>
                        </li>
                        <li class="col-lg-6">
                           <span class="custom-radio">
                           <input type="radio" id="6" value ="0" name="lookingForLoan">
                           <label for="6"></label>
                           </span>
                           No
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group mx-0">
                     <label>I need Franchise</label>
                     <ul class="list-unstyled d-flex flex-wrap">
                        <li class="col-lg-6">
                           <span class="custom-radio">
                           <input type="radio" name="lookingForFranchisee" value ="1" id="11" checked>
                           <label for="11"> </label>
                           Yes
                           </span>
                        </li>
                        <li class="col-lg-6">
                           <span class="custom-radio">
                           <input type="radio" id="21" value ="0" name="lookingForFranchisee">
                           <label for="21"></label>
                           </span>
                           No
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group mx-0">
                     <label>Services</label>
                     <div class="row">
                        @if(isset($services))
                        @foreach($services as $srv)
                        <div class="checkboxes col-md-4">
                           <span class="custom-checkbox">
                           <input type="checkbox" id="service{{$srv->id}}" name="lookingForServices[]" value="{{$srv->id}}">
                           <label for="service{{$srv->id}}"></label>
                           </span>
                           {{$srv->title}}
                        </div>
                        @endforeach
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group mx-0">
                     <label>Password</label>
                     <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password">
                     @error('password')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group mx-0">
                     <label>Confirm Password</label>
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
   @if(isset($meta->lookingForFranchisee))
    var franchisee = {!! $meta->lookingForFranchisee !!};
       $('[name="lookingForFranchisee"]').each(function(){
           if(franchisee == $(this).val()){
           $(this).attr('checked',true);
       }
   });
      
   @endif
   
    @if(isset($meta->franchiser))
    
       var franchiser = {!! $meta->franchiser !!};
       $('[name="franchiser"]').each(function(){
           if(franchiser == $(this).val()){
           $(this).attr('checked',true);
       }
       });
       
   @endif
   @if(isset($meta->lookingForLoan))
    
       var loan = {!! $meta->lookingForLoan !!};
       $('[name="lookingForLoan"]').each(function(){
           if(loan == $(this).val()){
           $(this).attr('checked',true);
       }
       });
       
   @endif
   
    @if(isset($meta->lookingForInvestment))
    
       var invest = {!! $meta->lookingForInvestment !!};
       $('[name="lookingForInvestment"]').each(function(){
           if(invest == $(this).val()){
           $(this).attr('checked',true);
       }
       });
       
   @endif
   
    @if(isset($meta->lookingForServices))
    
       var services = {!! $meta->lookingForServices !!};
   
       $('[name="lookingForServices[]"]').each(function(){
   
           if(services.indexOf($(this).val()) != -1){
           $(this).attr('checked',true);
       }
       });
       
   @endif
   
</script>
@endsection
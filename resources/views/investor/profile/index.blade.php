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
         <form method="POST" action="{{ route('investor.updateprofile') }}" accept-charset="UTF-8" id="editProfileform" name="editProfileform" class="form-horizontal"  enctype="multipart/form-data">
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
               <div class="col-md-6">
                  <div class="form-group mx-0">
                     <label>{{ __('Maximum Investment Amount (INR)') }}</label>
                     <input id="maxinvestment" type="number" class="form-control @error('maxinvestment') is-invalid @enderror" name="maxinvestment" value="{{ old('name',$meta->maxinvestment ?? '') }}" required autocomplete="maxinvestment" placeholder="Amount">
                     @error('maxinvestment')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group mx-0">
                     <label>{{ __('Profile Picture') }}</label>
                     <div class="custom-file-upload">
                        <input type="file" id="file" name="picture"/>
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
                     @error('location')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
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
            </div>

            <div class="row">
               <div class="col-md-6">
                  <div class="col-md-12 px-0" style="margin-bottom: 12px;">
                     <label>{{ __('Behaviour') }}</label>
                 </div>
                 <div class="form-group mx-0">
                    <div class="col-md-6">
                       <span class="custom-radio">
                       <input type="radio" id="1" name="investortype" value="sleeping" {{$meta->investortype=='sleeping' || $meta->investortype== '' ? 'checked':''}}>
                       <label for="1" > </label>
                       Sleeping Partner
                       </span>
                    </div>
                    <div class="col-md-6">     
                       <span class="custom-radio">
                       <input type="radio" id="2" name="investortype" value="working" {{$meta->investortype=='working' ? 'checked':''}}>
                       <label for="2" > </label>
                       Working Partner
                       </span>
                    </div>
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
            <div class="row businessType">
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
               <div class="col-md-12 px-0">
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
   $(function(){

       $('[name="franchiser"]').change(function(){
           var fr1 = $('[name="franchiser"]:checked').val();
           if(fr1 == 0){
               $(".businessType").hide();
       }else{
         $(".businessType").show();
       }
       });
   
       @if(isset($meta->franchiser))
        var fr1 = $('[name="franchiser"]:checked').val();
        if(fr1 == 0){
           $(".businessType").hide();
       }
       @endif
   });
   
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
        


</script>
@endsection
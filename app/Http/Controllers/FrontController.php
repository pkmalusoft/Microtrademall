<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Models\Plan;
use App\Models\Blog;
use App\Activeplans;
use App\UserMeta;
use App\Wishlist;
use App\General;
use Carbon\Carbon;
use Session;
use Auth;
use Mail;
use DB;
use App\Models\Service;
class FrontController extends Controller
{

    public function welcome(){
        $services = Service::all();
        $investors = User::query()->where('users.role','=',2)
            ->leftJoin('active_plans','active_plans.user_id','=','users.id')
           ->leftJoin('plans','plans.id','=','active_plans.plan_id')
           ->select('users.*')
           ->orderBy('plans.price','desc')->get();

        $investees = UserMeta::query()->where('lookingForInvestment','=',1)
            ->join('users','users.id','=','usermeta.user_id')
            ->leftJoin('active_plans','active_plans.user_id','=','usermeta.user_id')
           ->leftJoin('plans','plans.id','=','active_plans.plan_id')
           ->select('usermeta.*','users.name as name')
           ->orderBy('plans.price','desc')->get();

        $providers = UserMeta::
        join('users', function($join){
            return $join->on('users.id','=','usermeta.user_id')->where('users.role', '=', 3);
        })
        ->leftJoin('active_plans','active_plans.user_id','=','usermeta.user_id')
        ->leftJoin('plans','plans.id','=','active_plans.plan_id')
        ->select('usermeta.*', 'users.name as name','plans.price as price')
        ->orderBy('plans.price','desc')->get();

        $blogs = Blog::take(3)->get();
         return view('front.welcome',compact('services','investors','investees','providers','blogs'));
    }

    // Blog

    public function blogSingle(Request $request, $id){

        $blog = Blog::where('id',$id)->get();
        return view('front.blog-single',compact('blog'));
    }

    // PRICING PAGE
    
    public function frontPricing(){
        $plans = Plan::orderBy('price','asc')->get();
        return view('front.pricing',compact('plans'));
    }
public function socialverify(){
        if(!Session::has('socialUser')){
            abort(404, 'Something went wrong.');
            return;
        }
        $roles=Role::all()->where('id','!=',1);
        return view('login.social-verify',compact('roles'));
    }

    public function socialregister(Request $request){

         if(Session::has('socialUser')){
            $socialUser = session('socialUser');
           
             $this->validate(request(), [
            'terms' => ['required',  'accepted'],
             'role' =>  ['required', 'integer','','in:2,3,4'],
             
        ]);

              $newUser = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'google_id'=> $socialUser->id,
                    'password' => encrypt('123456dummy'),
                    'role' =>$request->role,
                ]);
                   
                UserMeta::create(['user_id' => $newUser->id]);
                Auth::login($newUser);
     
                return redirect('/dashboard');
        }
        else{
            return redirect('/register');
        }
    }

    public function reregister(){
       Session::flush();
       return redirect()->route('register');
    }

    public function resendOtp(){
        if(Session::has('userData')){
            
        } else{
           Session::flush();
           return redirect()->route('register')->with('verifyFail','Something went wrong. Please try again.');
        }
    }

    // CONTACT PAGE
    
    public function contact(){
        return view('front.contact');
    }

    // ABOUT PAGE

    public function about(){
        $about = General::first()->select('about')->get();
        return view('front.about',compact('about'));
    }

    public function terms(){
        $terms = General::first()->select('terms')->get();
        return view('front.terms',compact('terms'));
    }

    // CONTACT FORM PAGE

     public function contactForm(Request $request){
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $data = $request->all();
         Mail::send(['html'=>'contactEnquiry'],['data' => $data], function($message)  {
            $message->to('rswebs3@gmail.com', 'Micro Investors Contact Form')->subject('Contact Form Enquiry');
            $message->from('mail@truebooksoft.com','Micro Investors');
        });
        $msg = 'Thank you for your message. It has been sent.';
        return view('front.contact',compact('msg'));
    }

    // HOME SEARCHBAR
    
    public function franchiser(){
        $users =  UserMeta::where('franchiser',1)
        ->leftJoin('active_plans','active_plans.user_id','=','usermeta.user_id')
        ->leftJoin('plans','plans.id','=','active_plans.plan_id')
        ->select('usermeta.*')
        ->orderBy('plans.price','desc')->get();

        return view('front.franchisers',compact('users'));
    }

    public function loanProviders(){
        $users =  UserMeta::where('services','like','%14%')->get();
        return view('front.loanproviders',compact('users'));
    }

    // LOAN SEEKERS LIST
    
    public function loanSeeker(){
        $users =  UserMeta::where('lookingForLoan',1)
        ->leftJoin('active_plans','active_plans.user_id','=','usermeta.user_id')
        ->leftJoin('plans','plans.id','=','active_plans.plan_id')
        ->select('usermeta.*')
        ->orderBy('plans.price','desc')->get();
        return view('front.loanseeker',compact('users'));
    }


    // FRANCHISEE SEEKERS LIST
    
     public function franchiseeSeeker(){
        $users =  UserMeta::where('lookingForFranchisee',1)
        ->leftJoin('active_plans','active_plans.user_id','=','usermeta.user_id')
        ->leftJoin('plans','plans.id','=','active_plans.plan_id')
        ->select('usermeta.*')
        ->orderBy('plans.price','desc')->get();

        return view('front.FranchiseeSeeker',compact('users'));
    }


    // INVESTORS LIST
    
    public function frontInvestor(){
        $lat = isset($_GET['lat']) && $_GET['lat'] != '' ? $_GET['lat'] : null; 
        $long = isset($_GET['long']) && $_GET['long'] != '' ? $_GET['long'] : null; 
        $type = isset($_GET['type']) && $_GET['type'] != '' ? $_GET['type'] : null;

//        $cities = UserMeta::select(DB::raw('*, ( 6371 * acos( cos( radians(30.8356679) ) * cos( radians( lat ) ) * 
// cos( radians( lng ) - radians(76.1910284) ) + sin( radians(30.8356679) ) * 
// sin( radians( lat ) ) ) ) AS distance'))
//     ->having('distance', '<', 50)
//     // ->orderBy('distance')
//     ->get();

        // $users = User::query()->where('users.role','=',2)
        $users = UserMeta::query()->join('users','users.id','usermeta.user_id')
            ->where('users.role','=',2)
            ->select('usermeta.*','users.*', 'lat','lng')
            ->when($lat, function( $q ) use ($lat , $long ) {
                return $q->selectRaw('usermeta.*,users.*, lat,lng, ( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * 
                    cos( radians( lng ) - radians('.$long.') ) + sin( radians('.$lat.') ) * 
                    sin( radians( lat ) ) ) ) AS distance')->having('distance', '<=', 50)->where('lat', '!=' , null);
            })
            ->when($type, function( $q ) use ($type ) {
                return $q->where('usermeta.investortype', '=' , $type);
            })
            ->leftJoin('active_plans','active_plans.user_id','=','users.id')
           ->leftJoin('plans','plans.id','=','active_plans.plan_id')
           ->orderBy('plans.price','desc')->get();
    	return view('front.investors',compact('users'));
    }

    // FILTERED INVESTORS
    
     public function filteredInvestors(Request $request)
    {
        $users = UserMeta::query()->
        when(request()->has('location'), function($q) use ($request) {
            return $q->where('city','like','%'.$request->location.'%');
        })
         ->when(request()->has('investortype'), function($q) use ($request){
            return $q->where('investortype','like','%'.$request->investortype.'%');
        })
        ->join('users', function($join){
            return $join->on('users.id','=','usermeta.user_id')->where('users.role', '=', 2);
        })
        ->leftJoin('active_plans','active_plans.user_id','=','usermeta.user_id')
        ->leftJoin('plans','plans.id','=','active_plans.plan_id')
        ->select('usermeta.*')
        ->orderBy('plans.price','desc')->get();
        return view('front.filtered-investors',compact('users'));
    }


    // INVESTEES LIST
    
    public function frontInvestee(){
        $location = isset($_GET['location']) && $_GET['location'] != '' ? $_GET['location'] : null; 
        $users = UserMeta::query()->where('lookingForInvestment','=',1)->
            when($location, function($q) use ($location) {
                return $q->join('users','users.id','usermeta.user_id')
                ->where('city','LIKE','%'.$location.'%');
            })
        ->leftJoin('active_plans','active_plans.user_id','=','usermeta.user_id')
        ->leftJoin('plans','plans.id','=','active_plans.plan_id')
        ->select('usermeta.*')
        ->orderBy('plans.price','desc')->get();

        return view('front.investee',compact('users'));
    }



    // SINGLE SERVICE USERS LIST
    
     public function frontService($id){
    	   $service = Service::findOrFail($id);
           $userId = UserMeta::where('usermeta.services','LIKE','%"'.$id.'"%')
           ->leftJoin('active_plans','active_plans.user_id','=','usermeta.user_id')
           ->leftJoin('plans','plans.id','=','active_plans.plan_id')
           ->select('usermeta.*')
           ->orderBy('plans.price','desc')->get();
     	  return view('front.single-service-providers',compact('userId','id','service'));
    }


    // ALL SERVICES LIST
    
    public function frontServiceAll(){
           $lat = isset($_GET['lat']) && $_GET['lat'] != '' ? $_GET['lat'] : null; 
           $long = isset($_GET['long']) && $_GET['long'] != '' ? $_GET['long'] : null;
           $type = isset($_GET['type']) && $_GET['type'] != '' ? $_GET['type'] : null;
           $exp  = isset($_GET['e']) && $_GET['e'] != '' ? $_GET['e'] : null;


           // $userId = User::query()->where('role','=',3)->
           $userId = Usermeta::query()->join('users','users.id','usermeta.user_id')->where('users.role','=',3)
            ->select('usermeta.*','users.*', 'lat','lng')
            ->when($lat, function( $q ) use ($lat , $long ) {
                return $q->selectRaw('usermeta.*,users.*, lat,lng, ( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * 
                    cos( radians( lng ) - radians('.$long.') ) + sin( radians('.$lat.') ) * 
                    sin( radians( lat ) ) ) ) AS distance')
                    ->where('lat', '!=' , null)
                    ->having('distance', '<=', 50);
            })
            ->when($exp, function( $q ) use ($exp ) {
                return $q->where('usermeta.experience', '=' , $exp);
            })
            ->when($type, function( $q ) use ($type ) {
                return $q->where('usermeta.jobtype', '=' , $type);
            })

            ->leftJoin('active_plans','active_plans.user_id','=','users.id')
            ->leftJoin('plans','plans.id','=','active_plans.plan_id')
           
            // ->select('users.*')
            ->orderBy('plans.price','desc')->get();
          return view('front.service-providers',compact('userId'));
    }


    // FILTERED SERVICES
    
    public function filteredServices($id, Request $request)
    {
    $service = Service::findOrFail($id);
     $lat =  $request->lat != '' ? $request->lat : null; 

     $userId = UserMeta::query()->where('usermeta.services','LIKE','%"'.$id.'"%')
        ->select('usermeta.*')
        ->when($lat, function( $q ) use ($lat,$request) {
        return $q->selectRaw('usermeta.*, ( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) *cos( radians( lng ) - radians('.$request->long.') ) + sin( radians('.$lat.') ) * sin(radians( lat ) ) ) ) AS distance')
            ->where('lat', '!=' , null)
            ->having('distance', '<=', 50);
            })
         ->when(request()->has('jobtype'), function($q) use ($request){
            return $q->where('jobtype','like','%'.$request->jobtype.'%');
        })
        ->when(request()->has('experience'), function($q) use ($request){
            return $q->where('experience','like','%'.$request->experience.'%');
        })
        ->leftJoin('active_plans','active_plans.user_id','=','usermeta.user_id')
        ->leftJoin('plans','plans.id','=','active_plans.plan_id')
        ->orderBy('plans.price','desc')
        ->get();
         return view('front.single-service-providers',compact('userId','id', 'service'));
    }

    //Filtered Services All

      public function allFilteredServices(Request $request)
    {

     $userId = $userId = User::query()->where('role','=',3)->join('usermeta','usermeta.user_id','=','users.id')->
        when(request()->has('location'), function($q) use ($request) {
            return $q->where('usermeta.city','like','%'.$request->location.'%');
        })
         ->when(request()->has('jobtype'), function($q) use ($request){
            return $q->where('usermeta.jobtype','like','%'.$request->jobtype.'%');
        })
        ->when(request()->has('experience'), function($q) use ($request){
            return $q->where('usermeta.experience','like','%'.$request->experience.'%');
        })
        ->leftJoin('active_plans','active_plans.user_id','=','users.id')
            ->leftJoin('plans','plans.id','=','active_plans.plan_id')
            ->select('users.*','usermeta.city')
            ->orderBy('plans.price','desc')->get();
        // dd($userId);
         return view('front.service-providers',compact('userId'));
    }

    // Filter Investees or loan seekers

    public function filteredInvesteesOrLoan(Request $request)
    {
        $lookingFor = $request->lookingfor;
        $lat =  $request->lat != '' ? $request->lat : null; 
    
        $users = UserMeta::query()->where($lookingFor,1)

         ->when($lat, function( $q ) use ($lat,$request) {
                return $q->selectRaw('usermeta.*, ( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * 
                    cos( radians( lng ) - radians('.$request->long.') ) + sin( radians('.$lat.') ) * 
                    sin( radians( lat ) ) ) ) AS distance')
                    ->where('lat', '!=' , null)
                    ->having('distance', '<=', 50);
            })
         ->when(request()->has('businessType'), function($q) use ($request){
             return $q->whereIn('businessType',$request->businessType);
        })->get();

      if (($lookingFor == 'lookingForLoan')) {
			$view = 'front.loanseeker';
		} else {
			if (($lookingFor == 'franchiser')) {
				$view = 'front.franchisers';
			} else {
				if (($lookingFor == 'lookingForFranchisee')) {
					$view = 'front.FranchiseeSeeker';
				} else {
					$view = 'front.investee';
				}
			}
		}

        return view($view,compact('users'));
    }


    // HOME SEARCHBAR
    
    public function homeSearchbar(Request $request)
    {
        if($request->lookingfor != ''){
            return redirect('/'.$request->lookingfor.'?lat='.$request->lat.'&long='.$request->long);
        }
        else{
            return redirect()->back();
        }
    }

   
    // SINGLE USER PROFILE
    
     public function profile($id){
        $user =  User::where('users.id',$id)->join('roles','roles.id','users.role')->select('users.*','roles.title as roletitle')->first();
        $rlsrv = $user->usermeta->services == null ? '' : json_decode($user->usermeta->services);
        $relatedUser =  Usermeta::where(function ($query) use ($rlsrv) {
            if(is_array($rlsrv)){
                foreach ($rlsrv as $key => $value) {
                    $query->orWhere('services', 'LIKE', '%"'.$value.'"%');
                }
            }
        })
        ->join('users','users.id','usermeta.user_id')
        ->where('users.role',$user->role)
        ->where('usermeta.user_id','!=',$user->id)
        ->select('usermeta.*','users.role','users.name as name')->get();
        $wishlist = $detailInfo = 0;
        if(!Auth::guest()){
            $wishlist = Wishlist::where('user_id',Auth::user()->id)->where('profile',$id)->first();
            $actPlan = Activeplans::where('user_id',Auth::user()->id)->whereDate('end','>=',Carbon::today())->orderBy('id', 'DESC')->first();
            if($actPlan != null){ $detailInfo = 1;}
            if($wishlist != null){ $wishlist = 1;}
        }
        return view('front.single-user',compact('user','detailInfo','relatedUser','wishlist'));
    }



}

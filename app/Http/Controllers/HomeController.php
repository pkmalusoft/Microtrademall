<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activeplans;
use App\Wishlist;
use App\User;
use App\Models\Plan;
use Textlocal;
use Auth;
use Session;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('login.dashboard');
    }

    // ACTIVE PLANS
    public function activeplan(){
        $plan = Activeplans::whereDate('end','>=',Carbon::today())->where('user_id',Auth::user()->id)->join('plans','plans.id','plan_id')
            ->select('active_plans.*','plans.duration as plan_duration')->get();
        return view('login.plan.index',compact('plan'));
    }
    
    public function wishlist(){
        $wishlist = Wishlist::where('wishlists.user_id',Auth::user()->id)->join('users','users.id','wishlists.profile')->select('wishlists.*','users.name as username','users.id as userId')->get();
        return view('login.wishlist.index',compact('wishlist'));
    }


    public function userVerify(Request $request){

        if(isset($request->otp) && Session::has('verifyMe')){
            if($request->otp == Session::get('verifyMe')){
                User::where('id', Auth::user()->id)->update(['verification' => null]);
                session()->forget(['verifyMe']);
                return redirect()->back()->with('otp','Your account has been verified successfully.');
            } else{
                return redirect()->back()->with('otperror','Verification failed. Entered OTP is incorrect.');
            }
        } else{
            if(Auth::user()->verification == '0'){
                $otp = userotp(Auth::user()->contact);
                Session::put('verifyMe', $otp);
                return redirect()->back();
            }
        }
    }


}

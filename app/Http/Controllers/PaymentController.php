<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Plan;
use App\Activeplans;
use Session;
use Response;
use Carbon\Carbon;

class PaymentController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function buyPlan($id) {
        $actPlan = Activeplans::where('user_id',Auth::user()->id)->whereDate('end','>=',Carbon::today())->orderBy('id', 'DESC')->get();
        if(count($actPlan) > 3){
		    return redirect('/activeplan')->with(['planinfo' => 'You already have reserved maximum number of plans at one time.']);	
        }
    	$plan = Plan::findOrFail($id);
        Session::put('planId', $id);
	    return view('login.pay', compact('plan'));	
	}

    public function freePlan($id) {
        $plan = Plan::findOrFail($id);
        $actPlan = Activeplans::where('user_id',Auth::user()->id)->whereDate('end','>=',Carbon::today())->orderBy('id', 'DESC')->first();

         if($actPlan != null){
            return redirect('/activeplan')->with(['planinfo' => 'Your free plan is already active.']); 
        }

        $currentDate = isset($actPlan->end) ? Carbon::parse($actPlan->end)->addDays(1) : Carbon::today();
        $offerEnd = Carbon::parse('02 Sept 2020')->diffInDays(Carbon::today());
        if($offerEnd < 1){
            return redirect('/activeplan')->with(['error' => 'Offer expired.']); 
        }
        $endDate = Carbon::parse($currentDate)->addDays($offerEnd);
        $data = array(
            'user_id' => Auth::user()->id,
            'plan_id' => $plan->id,
            'payment_id' => 'FREE',
            'start' => $currentDate,
            'end' => $endDate,
        );
        $activeplan = Activeplans::create($data);
        Session::flash('plan_success','Plan added successfully, Expiry date: 02 September 2020.');
        return redirect('/activeplan');
        // Please check browser console.
        exit;
    }
    

	public function proceedPayment(Request $request) {
	    //Input items of form
	    $input = $request->all();
	    $plan = Plan::findOrFail(Session::get('planId'));
	    if(!isset($input['razorpay_payment_id'])){
    		return Response::json(['status' => 0]);
	    	exit;
	    }
        $actPlan = Activeplans::where('user_id',Auth::user()->id)->whereDate('end','>=',Carbon::today())->orderBy('id', 'DESC')->first();
        $currentDate = isset($actPlan->end) ? Carbon::parse($actPlan->end)->addDays(1) : Carbon::today();
        $endDate = Carbon::parse($currentDate)->addDays($plan->duration);
	    $data = array(
    		'user_id' => Auth::user()->id,
    		'plan_id' => $plan->id,
    		'payment_id' => $input['razorpay_payment_id'],
    		'start' => $currentDate,
    		'end' => $endDate,

	    );
	    $activeplan = Activeplans::create($data);
	    Session::flash('plan_success','Plan added successfully.');
    	return Response::json(['status' => 200]);
	    // Please check browser console.
	    exit;
	}
}

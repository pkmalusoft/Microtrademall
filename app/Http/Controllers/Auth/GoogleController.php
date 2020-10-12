<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;
use App\Role;
use Session;

class GoogleController extends Controller
{
    //
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->stateless()->user();

         
   
            $finduserbyid = User::where('google_id', $user->id)->first();
            $finduserbyemail = User::where('email', $user->email)->first();
     
            if($finduserbyemail){
     
                Auth::login($finduserbyemail);
    
                return redirect('/dashboard');
     
            }elseif($finduserbyid){

            	 Auth::login($finduserbyid);
    
                return redirect('/dashboard');
            }else{


            	session(['socialUser' => $user]);
				
				return redirect('/social/verify');
            	
                // $newUser = User::create([
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'google_id'=> $user->id,
                //     'password' => encrypt('123456dummy')
                // ]);
    				
                // Auth::login($newUser);
     
                // return redirect('/dashboard');
            }
    
        } catch (Exception $e) {
            // dd($e->getMessage()); 
            dd($e);
        }
    }
}

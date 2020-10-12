<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Session;
use App\Role;
use App\UserMeta;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => ['required',  'unique:users','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
            'role' => ['required',  'integer','','in:2,3,4'],
            'terms' => ['required',  'accepted'],
            // 'username' => 'required|string|max:255|min:4|unique:users|alpha_num',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact' => $data['contact'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }


     public function register(Request $request)
    {
        $data = $request->all();
        if(!Session::has('userData')){
            $this->validator($data)->validate();
            Session::put('userData', $data);
        }

        if(!isset($data['otp'])){
            $usersession = Session::get('userData');
            $otp = sms($usersession['contact']);
            // $otp = rand(0,100000);
            Session::put('verifyMe', $otp);
            Session::put('otpfail', 0);
            return redirect()->back()->withInput($data)->with('otp','OTP verification needed.');
        } else{
            $failTimes = Session::get('otpfail');
            if($data['otp'] != Session::get('verifyMe')){
                if($failTimes > 2){
                    Session::flush();
                    return redirect()->route('register')->with('verifyFail','Verification failed. Please follow the process again');
                }
                Session::put('otpfail', $failTimes+1);
                return redirect()->back()->withInput($data)->with('otp','OTP not verified')->with('otperror','Invalid otp. Please try again');
            } else{
                $userData =  Session::get('userData');
                $userData['_token'] =  $data['_token'];

                event(new Registered($user = $this->create($userData)));
                UserMeta::create(['user_id' => $user['id']]);
                $this->guard()->login($user);
                return $this->registered($request, $user) ?: redirect($this->redirectPath());
            }
        }
    }

    public function showRegistrationForm()
    {
        $roles=Role::all()->where('global','==',Null);
        return view('auth.register', compact('roles'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Plan;
use App\User;
use App\UserMeta;
use App\Role;
use App\General;
use Auth;

class adminController extends Controller
{
    public function index(){
    	return view('admin.dashboard');
    }

    public function terms(){
        $terms = General::first();
        return view('admin.terms.index', compact('terms'));
    }

    public function saveTerms(Request $request){
        $terms['terms'] = $request->terms;
        $terms['about'] = $request->about;
        try {
           $gen = General::first();
           $save = $gen != null ?  General::where('id',$gen->id)->update($terms) :  General::create($terms);
            return back()
                ->with('success_message', 'Terms saved successfully.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred.']);
        }
        
    }


    public function listusers(){
    	$searchrole = isset($_GET['role']) && $_GET['role'] != '' ? $_GET['role'] : null;
    	$searchname = isset($_GET['name']) && $_GET['name'] != '' ? $_GET['name'] : null;
    	$roles = Role::all();
    	$users = User::sortable()
            ->join('roles','users.role','roles.id')
            ->select('users.*','roles.title','roles.id as roleId')

            ->when($searchrole, function ($query) use ($searchrole) {
                return $query->where('role',$searchrole);
            })
            ->when($searchname, function ($query) use ($searchname) {
                return $query->where('name','LIKE', '%'.$searchname.'%');
            })
            ->get();

    	// if(isset($_GET['role']) && $_GET['role'] != ''){
	    // 	$users = User::sortable()->where('role',$_GET['role'])
     //        ->join('roles','users.role','roles.id')
     //        ->get();
    	// }
    	return view('admin.users.index',compact('users','roles'));
    }

    public function addusers(){
        if(Auth::user()->role == 1){
            $roles=Role::all()->where('id','!=',1);
        } else{
            $roles=Role::all()->where('global','==',Null);
        }
        return view( 'admin.users.add', compact('roles') );
    }

    public function createuser(Request $request){

        $roles = Auth::user()->role == 1 ? '2,3,4,5' : '2,3,4';
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:35', 'unique:users'],
            'contact' => ['required',  'unique:users','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
            'role' => ['required',  'integer','','in:'.$roles],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $data = $request->all();
        $data['verification'] = 0;
        $data['password'] = Hash::make($data['password']);
        $uname = substr($request['email'],0, strpos($request['email'], '@'));

        try {
           
            $username = $data['email'];
            $cred = user_register($request['contact'],$username,$request['password']);
            $user = User::create($data);
            User::where('id', $user->id)->update(['username' => $uname.$user->id]);
            UserMeta::create([ 'user_id' => $user->id ]);
            return back()
                ->with('success_message', 'User created successfully.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred.']);
        }
    }

}

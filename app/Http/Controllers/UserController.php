<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Auth;

use App\UserMeta;

use App\Models\Service;

class UserController extends Controller

{

    public function editProfile(){

        $meta = UserMeta::where('user_id',Auth::user()->id)->first();

        $services = Service::orderBy('title','ASC')->get();

    	return view('user.profile.index',compact('meta','services'));

    }



    public function updateProfile(Request $request){

    	$user = Auth::user();

    	 $this->validate($request, [

	        'name' => 'required|max:255|unique:users,name,'.$user->id,

	        'password' => 'sometimes|string|min:6|confirmed|nullable',

            'picture' => 'mimes:jpeg,jpg,png|max:3500',

            'introduction' => 'nullable|string|min:5',

            'location' => 'required|string|min:5',

            'services' => 'nullable',

            'city' => 'required|string|min:2',

            'businessType'=>'required',

            'franchiser'=>'required|in:0,1',

            'lookingForInvestment'=>'required|in:0,1',

            'lookingForLoan'=>'required|in:0,1',

            'lookingForFranchisee'=>'required|in:0,1',

            'lookingForServices[]'=>'nullable',

            'long'=>'required',

            'lat'=>'required',

	    ],
        [
            'long.required' => 'Please enter a valid location.',
            'lat.required' => '',
        ]
        );

    	$input = $request->only('name');

    	if($request->password != ''){

    		$input['password'] =  bcrypt($request->password);

    	}

         $meta = array(

            'introduction'  => $request->introduction,

            'location'      => $request->location,

            'lookingForServices'      => json_encode($request->lookingForServices),

            'city'      => $request->city,

            'state'      => $request->state,

            'pincode'      => $request->pincode,

            'businessType'  => $request->businessType,

            'franchiser'      => $request->franchiser,

            'lookingForInvestment'      => $request->lookingForInvestment,

            'lookingForLoan'      => $request->lookingForLoan,

            'lookingForFranchisee'      => $request->lookingForFranchisee,
            'lng'      => $request->long,
            'lat'      => $request->lat,
        );

        if($request->hasFile('picture')) {  

            $file = $request->file('picture');

            $photo = md5(mt_rand(0,100000000000)).Auth::user()->id.'.'.$file->getClientOriginalExtension();

            $file->move(base_path().'/public/media/',$photo);

            $meta['picture'] = $photo; 

        }

    	try {

            UserMeta::where('user_id',Auth::user()->id)->update($meta);

    		$user->update($input);

    		return redirect()->back()->with('success_message', 'Updated successfully.');

    	} catch (Exception $e) {

			return back()->withInput()

                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);    		

    	}

    }





    

    public function updateMeta($name, $value) {

        $meta = UserMeta::where("key", $name)->where("user_id", Auth::user()->id)->first();

        if (!$meta) {

            $meta = new UserMeta;

            $meta->name = $name;

        }

        $meta->value = $value;

        UserMeta::save($meta);

    }



}


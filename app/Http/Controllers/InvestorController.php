<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Auth;

use App\User;

use App\UserMeta;

class InvestorController extends Controller

{



    public function editProfile(){

        $meta = UserMeta::where('user_id',Auth::user()->id)->first();

    	return view('investor.profile.index',compact('meta'));

    }





    public function updateProfile(Request $request){

    	$user = Auth::user();

    	 $this->validate($request, [

	        'name' => 'required|max:255|unique:users,name,'.$user->id,

            'profile' => 'required|max:255|min:3',

	        'password' => 'sometimes|string|min:6|confirmed|nullable',

            'picture' => 'mimes:jpeg,jpg,png|max:1000',

            'investortype' => 'required|in:sleeping,working',

            'lookingForFranchisee'=>'required|in:0,1',

            'businessType'=>'nullable',

            'long'=>'required',
            
            'lat'=>'required',

            'franchiser'=>'required|in:0,1',

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

            'maxinvestment' => $request->maxinvestment,
            'introduction'  => $request->introduction,
            'location'      => $request->location,
            'city'      => $request->city,
            'investortype'      => $request->investortype,
            'franchiser'      => $request->franchiser,
            'businessType'  => $request->businessType,
            'lookingForFranchisee'      => $request->lookingForFranchisee,
            'profile'      => $request->profile,
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

}


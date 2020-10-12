<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserMeta;
use App\Models\Service;
class ServiceProviderController extends Controller
{
    public function editProfile(){
        $meta = UserMeta::where('user_id',Auth::user()->id)->first();
        $services = Service::orderBy('title','ASC')->get();
    	return view('serviceProvider.profile.index',compact('meta','services'));
    }

    public function updateProfile(Request $request){

    	$user = Auth::user();
        $services = Service::all()->pluck('id')->toArray();
    	$this->validate($request, [
	        'name' => 'required|max:255|unique:users,name,'.$user->id,
            'profile' => 'required|max:255|min:3',
	        'password' => 'sometimes|string|min:6|confirmed|nullable',
            'picture' => 'mimes:jpeg,jpg,png|max:3500',
            'introduction' => 'nullable|string|min:5',
            'skills' => 'required|string|min:2',
            'location' => 'required|string|min:5',
            'services' => 'required',
            'city' => 'required|string|min:2',
            'experience'=>'required|in:-1,12,23,34,45,50',
            'jobtype'=>'required|in:freelancer,company',
            'long'=>'required',
            'lat'=>'required',
            // 'services' => 'required|in:'.implode(',',$services),
	    ],
        [
            'long.required' => 'Please enter a valid location.',
            'lat.required' => '',
        ]);
    	$input = $request->only('name');
    	if($request->password != ''){
    		$input['password'] =  bcrypt($request->password);
    	}
        $meta = array(
            'introduction' => $request->introduction,
            'location'     => $request->location,
            'services'     => json_encode($request->services),
            'city'         => $request->city,
            'skills'       => $request->skills,
            'experience'   => $request->experience,
            'jobtype'      => $request->jobtype,
            'profile'      => $request->profile,
            'lng'          => $request->long,
            'lat'          => $request->lat
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

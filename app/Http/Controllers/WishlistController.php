<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;
use Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {   
       try {
         $go = Wishlist::create(['user_id' => Auth::user()->id, 'profile' => $id]);
             return back()->with(['success_message' => 'Added successfully.']);
         } catch (Exception $exception) {
            return back()->with(['error_message' => 'Unexpected error occurred.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = Wishlist::where('profile',$id)->where('user_id',Auth::user()->id)->first();
            Wishlist::destroy($item->id);
             return back()->with(['success' => 'Profile removed successfully.']);
         } catch (Exception $exception) {
            return back()->with(['error_message' => 'Unexpected error occurred.']);
        }
    }
}

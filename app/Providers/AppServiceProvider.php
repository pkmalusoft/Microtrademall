<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;   
use DB;
use View;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $servicesList = DB::table('services')->get();
        $locs         = DB::table('usermeta')->distinct()->where('city','!=','')->get('city');
        $businessList = DB::table('usermeta')->distinct()->where('businessType','!=','')->get('businessType');
        $newMsg = $userImage = ' ';

        View::composer('*', function($view) use($servicesList,$locs,$businessList, $newMsg,$userImage) {
            if(Auth::check()){
            $userImage = DB::table('usermeta')->where('user_id', Auth::user()->id)->select('picture')->get();
             $newMsg =  DB::table('chats')
                ->whereIn('status', [0,5])
                ->where('reciever',Auth::user()->id)
                ->where('deletedby', '!=', Auth::user()->id)
                ->distinct('user_id')
                ->count();
                // dd($newMsg);
            }
            $view->with([
                'servicesList' => $servicesList,
                'businessList' => $businessList,
                'newMsg' => $newMsg,
                'locs' => $locs,
                'userImage' =>$userImage
            ]);
        });
    }
}   

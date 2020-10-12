<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use App\Services\SocialAuthService;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function callback(SocialAuthService $service)
    {
    	$user = $service->createOrGetUser(Socialite::driver('facebook')->stateless()->user());
    	auth()->login($user);

        return redirect()->to('/dashboard');
    }
}

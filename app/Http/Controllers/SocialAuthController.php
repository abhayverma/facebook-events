<?php

namespace App\Http\Controllers;

use App\Events\AuthenticateUser;
use Illuminate\Http\Request;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Listeners\AuthenticateUserListener;

class SocialAuthController extends Controller implements AuthenticateUserListener
{
    
    public function __construct(Socialite $socialite)
    {
       $this->socialite = $socialite;
    }

    public function login(AuthenticateUser $authenticateUser, Request $request)
    {
        return $authenticateUser->execute($request->has('code'), $this);
    }

    public function userHasLoggedIn($user)
    { 
        return view('home', compact('user'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook;
use App\FacebookHelper;
use Session;

class SocialAuthController extends Controller
{

    private $fbHelper;
    
    public function __construct(FacebookHelper $fbHelper)
    {
        $this->fbHelper = $fbHelper;
    }

    public function index()
    {
        if(Session::has('fb_access_token'))    return redirect()->to('home');

        $loginUrl  = $this->fbHelper->getLoginUrl(env('FB_REDIRECT_CALLBACK_URL'), ['manage_pages', 'user_events']);

        return view('welcome', compact('loginUrl'));
    }

    public function handleCallback(Request $request)
    {
        $accessToken = $this->fbHelper->getAccessToken();

        Session::set('fb_access_token',  $accessToken);

        $user = $this->fbHelper->getUser('/me?fields=id, name, picture{url}', $accessToken);

        Session::set('name', $user->getName());
        Session::set('avatar', $user->getPicture()['url']);

        // $user = $this->socialite->driver('facebook')->fields([
        //     'name', 'email', 'events{name,picture,cover,place,start_time,end_time,description,is_page_owned}','about'
        //     ])->user();

        return redirect()->to('home');
    }
}
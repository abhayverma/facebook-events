<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacebookHelper;
use Session;
use Auth;

class MainController extends Controller
{

	private $fbHelper;
    
    public function __construct(FacebookHelper $fbHelper)
    {
        $this->fbHelper = $fbHelper;
    }

    public function listPages()
    {
    	if( ! Session::has('fb_access_token'))	return redirect()->to('/')->with('AuthError', 'Hey! You forgot to login!!');

    	$pageList = $this->fbHelper->getPages('/me/accounts', Session::get('fb_access_token'))->getDecodedBody()['data'];

        return view('list_pages', compact('pageList'));
    }

    public function getEvents($page_id)
    {
    	$events = $this->fbHelper->getPages('/me/accounts', Session::get('fb_access_token'));
    	dd($page_id);
    }

    public function forgetUser()
    {
        Auth::logout();
		Session::flush();
		return redirect()->to('/');
    }
}
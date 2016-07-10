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

    	$pageList = $this->fbHelper->getData('/me/accounts/?fields=name,category,picture.type(normal)', Session::get('fb_access_token'))->getDecodedBody()['data'];

        return view('list_pages', compact('pageList'));
    }

    public function listEvents($page_id)
    {

    	if( ! Session::has('fb_access_token'))	return redirect()->to('/')->with('AuthError', 'Hey! You forgot to login!!');

    	$latestEvents = $this->fbHelper->getData("{$page_id}/events?fields=description,name,start_time,end_time,ticket_uri,cover.type(large)&since=today", Session::get('fb_access_token'))->getDecodedBody();

    	$pastEvents = $this->fbHelper->getData("{$page_id}/events?fields=description,name,place,start_time,end_time,picture.type(large)&until=today", Session::get('fb_access_token'))->getDecodedBody();

    	// $testEvents = $this->fbHelper->getData("me/events?fields=description,name,place,start_time,end_time,picture.type(large)&until=today&limit=6", Session::get('fb_access_token'))->getDecodedBody();

    	return view('list_events', compact('latestEvents', 'pastEvents'));
    }

    public function forgetUser()
    {
        Auth::logout();
		Session::flush();
		return redirect()->to('/');
    }
}
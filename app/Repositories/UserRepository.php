<?php

namespace App\Repositories;

use App\User;
use Log;

class UserRepository
{

    public function syncUser($userData)
    {
        if ( $user = $this->userRecordExists($userData->id) )
	    {
	        $user->username = $userData->name;
	        $user->avatar = $userData->avatar;
	        $user->save();

	        return $user;
	    }

	    return User::firstOrCreate([
	        'email'      => $userData->email,
	        'fbid'  	 => $userData->id,
	        'username'   => $userData->name,
	        'avatar'     => $userData->avatar
	    ]);  
    }

    private function userRecordExists($userID)
	{
	    return User::where('fbid', $userID)->first();
	}
}
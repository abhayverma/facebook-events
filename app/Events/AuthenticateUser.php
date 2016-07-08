<?php

namespace App\Events;

use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Contracts\Auth\Guard as Authenticator;
use App\Repositories\UserRepository;
use App\Listeners\AuthenticateUserListener;

class AuthenticateUser {
    
    /**
     * @var UserRepository
    */
    private $users; 

    /**
     * @var Socialite
    */
    private $socialite;

    /**
     * @var Authenticator
    */
    private $auth;
    
    public function __construct(UserRepository $users, Socialite $socialite, Authenticator $auth)
    {
        $this->users = $users;
        
        $this->socialite = $socialite;
        
        $this->auth = $auth;
    }
    
    public function execute($hasCode, AuthenticateUserListener $listener){
        
        if( ! $hasCode)  return $this->getAuth();

        $user = $this->users->syncUser($this->getUser());
        
        $this->auth->login($user, true);   // Maintain Session using Laravel Helper Class
            
        return $listener->userHasLoggedIn($user);        
    }
    
    public function getAuth(){
        
        return $this->socialite->driver('facebook')->redirect();      
        // return $this->socialite->driver('facebook')->scopes(['manage_pages', 'user_events'])->redirect();      
    }
    
    public function getUser(){
        
        return $this->socialite->driver('facebook')->user();  
        // return $this->socialite->driver('facebook')->fields(['id','name', 'email', 'picture', 'events', 'parent_page', 'about', 'global_brand_page_name', 'country_page_likes'])->user();       
    }
}
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    
    if(Auth::check()) return view('home');//'Welcome back, ' . Auth::user()->username;
    
    return view('welcome') ;
});

//Social Login
Route::get('/login', 'SocialAuthController@login');

Route::get('/modeltest', 'SocialAuthController@modelTests');

Route::get('/home', 'MainController@listPages');
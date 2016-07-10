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

// Landing Page
Route::get('/', 'SocialAuthController@index');

//Social Login
Route::get('/login/callback', 'SocialAuthController@handleCallback');

Route::get('/home', 'MainController@listPages');

Route::get('/logout', 'MainController@forgetUser');

Route::get('/events/{page_id}', 'MainController@listEvents');

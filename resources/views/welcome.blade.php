@extends('layout/primary')

@section('title')
    Welcome to Your Facebook Events Calender
@stop

@section('content')
	@if(Session::has('AuthError'))
		<h4 class="alert alert-danger text-center" role="alert">{{ Session::get('AuthError') }}</h4>
	@endif
    <div class="row text-center login-box">
        <div class="col-md-6 col-md-offset-3" style="padding:5px;">
            <h2>Let's Get Started</h2><hr>
            <p>Login with your facebook account to check out your events <br> In a very cool way</p><br>
            <a href="{{ $loginUrl }}" class="btn btn-primary btn-lg">Login using Facebook</a>
        </div>
    </div>
@stop

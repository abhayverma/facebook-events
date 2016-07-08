@extends('layout/primary')

@section('title')
    Welcome to Your Facebook Events Calender
@stop

@section('content')
    <div class="row text-center login-box">
        <div class="col-md-6 col-md-offset-3" style="padding:5px;">
            <h2>Let's Get Started</h2><hr>
            <p>Login with your facebook account to check out your events <br> In a very cool way</p><br>
            <a href="/login" class="btn btn-primary btn-lg">Login using Facebook</a>
        </div>
    </div>
@stop

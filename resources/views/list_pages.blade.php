@extends('layout\session')

@section('banner')
    <h1>Hey, {{ Session::get('name') }}</h1>
    <p>Welcome to Abby's Facebook Page Listing,<br>An easy and elegant way to find your pages and events</p>
@stop


@section('content')

	<div class="row">
	@foreach($pageList as $node)
	    <a href="/events/{{$node['id']}}" class="col-sm-4">
	      <div class="panel panel-primary">
	        <div class="panel-body text-center"><h1>{{$node['name']}}</h1></div>
	        <div class="panel-footer text-center"><h4>{{ $node['category'] }}</h4></div>
	      </div>
	    </a>
	@endforeach
  	</div>
    	
@stop
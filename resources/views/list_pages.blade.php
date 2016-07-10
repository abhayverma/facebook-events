@extends('layout\session')

@section('title')
Your Pages on Facebook
@stop

@section('content')

	<style type="text/css">
		.img-responsive {
		    margin: 0 auto;
		}
	</style>

	<div class="row">
	@foreach($pageList as $node)
	    <a href="/events/{{$node['id']}}" class="col-sm-4">
	      <div class="panel panel-default">
	      	<div class="panel-heading">{{$node['name']}}</div>
	        <div class="panel-body text-center">
	        	<img src="{{$node['picture']['data']['url']}}" class="img-responsive" style="width:50%" alt="{{$node['name']}}">
	        </div>
	        <div class="panel-footer text-center">{{ $node['category'] }}</div>
	      </div>
	    </a>
	@endforeach
  	</div>
    	
@stop
@extends('layout\session')

@section('title')
Events Listing
@stop

@section('content')
	
	<style type="text/css">
		
	</style>

	<link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>

	@if( ! sizeof($latestEvents['data']) && ! sizeof($pastEvents['data']))

		<h4 class="alert alert-warning text-center" role="alert">Hmm, no events available on this page.</h4>
		<div align="center">
			<img src="/empty.gif" width="50%">
		</div>

		<style type="text/css">.secondary-alert{display:none;}</style>

	@endif


	@if( ! sizeof($latestEvents['data']))

		<h4 class="alert alert-warning text-center secondary-alert fancy" role="alert">Hmm, can't find any upcoming events.</h4>

	@else

	<div id="upcomingCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
	    <!-- Indicators -->
	    <ol class="carousel-indicators visible-lg visible-md">
	      <?php $counter = 0; ?>
	      <li data-target="#upcomingCarousel" data-slide-to="0" class="active"></li>
	      @for($i=1 ; $i < sizeof($latestEvents['data']) ; $i++)
	     	 <li data-target="#upcomingCarousel" data-slide-to="{{$i}}"></li>
	      @endfor
	    </ol>

	    <!-- Wrapper for slides -->
	    <div class="carousel-inner" role="listbox">

	    	<?php $isFirst = true; date_default_timezone_set('Asia/Kolkata');?>

	    	<div class="transparent-overlay">&nbsp;</div>

	    	@foreach($latestEvents['data'] as $node)

	    		@if( ! $isFirst)

					<div class="item">

				@else   <?php $isFirst = false; ?>

	    			<div class="item active">

	    		@endif

						<img src="@if(isset($node['cover'])) {{$node['cover']['source']}} @else {{ '/no-image.jpg' }} @endif" alt="{{$node['name']}}">
						<div class="carousel-caption visible-lg visible-md">
							<h1>{{$node['name']}}</h1>
							@if(isset($node['description']))
								<h4>
									{{ substr($node['description'], 0, 200). " ... " }}
									<a href="{{ 'https://www.facebook.com/events/'. $node['id'] }}" target="_blank">read more</a>
								</h4>
							@endif
							<br>
							<h4>{{date('jS M Y', strtotime($node['start_time']))}}</h4>
							<a href="{{ $node['ticket_uri'] or '#' }}" class="btn btn-sm btn-default book-event">Book</a>
						</div>
						<div class="carousel-caption visible-xs visible-sm">
							<h1>{{$node['name']}}</h1>
							@if(isset($node['description']))
								<h4>
									{{ substr($node['description'], 0, 200). " ... " }}
									<a href="{{ 'https://www.facebook.com/events/'. $node['id'] }}" target="_blank">read more</a>
								</h4>
							@endif
							<h4>{{date('jS M Y', strtotime($node['start_time']))}}</h4>
							<a href="{{ $node['ticket_uri'] or '#' }}" class="btn btn-sm btn-default book-event">Book</a>
						</div>
					</div>
	    	@endforeach

	    </div>
	    <!-- Left and right controls -->
	    <a class="left carousel-control" href="#upcomingCarousel" role="button" data-slide="prev">
	      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#upcomingCarousel" role="button" data-slide="next">
	      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	      <span class="sr-only">Next</span>
	    </a>
	 
	</div>

	@endif


	<br><h2 class="text-center secondary-alert">Past Events</h2><br>


	@if( ! sizeof($pastEvents['data']))

		<h4 class="alert alert-warning text-center secondary-alert" role="alert">Hmm, can't find any past events.</h4>

	@else

		<div id="pastCarousel" class="carousel slide" data-ride="carousel"  data-interval="false">
		    <!-- Indicators -->

		    <!-- Wrapper for slides -->
		    <div class="carousel-inner" role="listbox">

		      	<?php $isFirst = true; $count = 0; $newSet = false; date_default_timezone_set('Asia/Kolkata');?>

		    	@foreach($pastEvents['data'] as $node)

		    		@if( ! $isFirst && ($count % 3 == 0) )

					<div class="item">

					@elseif($count % 3 == 0)	<?php $isFirst = false; ?>

		    		<div class="item active">

		    		@endif

			    		<div class="event-node col-sm-4">
							<div class="panel panel-default">
								<div class="panel-body text-center">
								<img src="{{ $node['picture']['data']['url'] }}" class="img-responsive" style="width:100%" alt="">
								</div>
								<div class="panel-footer text-center visible-lg visible-md">
									<h4>{{date('jS M \'y', strtotime($node['start_time']))}} | {{ $node['place']['name'] or 'Not Specified'}} </h4>
									<h1> {{ $node['name'] }} </h1>
									<h4 class="hidden event-desc"> {{$node['description'] or 'No Description Available.'}} </h4>
								</div>
								<div class="panel-footer text-center visible-xs visible-sm">
									<h4>{{date('jS M \'y', strtotime($node['start_time']))}} | {{ $node['place']['name'] or 'Not Specified'}} </h4>
									<h3> {{ $node['name'] }} </h3>
									<p class="hidden event-desc"> {{$node['description'] or 'No Description Available.'}} </p>
								</div>
							</div>
			            </div>

			        <?php $count++;	?>

			        @if($count % 3 == 0)

			        </div>

			        @endif

		    	@endforeach

		    </div>

		    <!-- Left and right controls -->
		    <a class="left carousel-control" href="#pastCarousel" role="button" data-slide="prev">
		      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		      <span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#pastCarousel" role="button" data-slide="next">
		      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		      <span class="sr-only">Next</span>
		    </a>
		</div>

	@endif
    	
@stop
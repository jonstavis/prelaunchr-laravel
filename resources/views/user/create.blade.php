@extends('layouts.master')

@section('body-class', 'user-create')

@section('og')
	<meta property="og:url" content="{{ homepage_url() }}" />
@stop

@section('content')

	@include('layouts._navigation')

	@include('flash::message')


	<header>
		<div class="bg"></div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-5 col-sm-offset-7">
					<h1>MidwestFit is Coming</h1>
					<h2>Your&nbsp;Journey Starts&nbsp;Here</h2>
					<p class="center">Try us out for free!<br/><br/>
						 Sign up before June 29th to be one of the first to get two weeks of full access.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5 col-sm-offset-7">
					@include('user._form')
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5 col-sm-offset-7">
					<div class="col-xs-10 col-xs-offset-1">
						<p class="center share-text">
							MidwestFit provides goal-oriented workout programs through a seamless, easy to use interface all based around your individual health assessment as well as your fitness goals.
						</p>
					</div>
				</div>	
			</div>
		</div>
	</header>

@stop

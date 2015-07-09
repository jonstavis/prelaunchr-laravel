<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="MidwestFit changes lives by providing goal-oriented fitness programs through a seamless user experience. Get full access and start your journey today for free, with no obligation."/>
    <meta name="author" content="MidwestFit">

    <title>MidwestFit | Life Changing Fitness Programs</title>

	@yield('og')
	<meta property="og:image" content="{{ asset('img/mwf-og-image2.png') }}" />
	<meta property="og:title" content="MidwestFit | Life Changing Fitness Programs" />
	<meta property="og:description" content="MidwestFit changes lives by providing goal-oriented fitness programs through a seamless user experience. Get full access and start your journey today for free, with no obligation." />
	<meta property="og:site_name" content="MidwestFit"/>
	<meta property="og:type" content="website"/>

	   <meta name="twitter:card" content="summary" >
    <meta name="twitter:domain" content="midwestfit.com" >
    <meta name="twitter:site" content="@midwestfit" >
    <meta name="twitter:site:id" content="166676493">
    <meta name="twitter:creator" content="@midwestfit" >
	

	<link href="{{ elixir_cachebust('css/app.css') }}" rel="stylesheet">

	<link rel="SHORTCUT ICON" HREF="{{ asset('img/favicon.png') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	@if (app()->env == 'production')
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-63973222-1', 'auto');
		  ga('send', 'pageview');

		</script>
	@endif

</head>

<body class="@yield('body-class')">

	@include('layouts._facebook')

	@yield('content')

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p class="center">
					Questions?  <a href="mailto:support@midwestfit.com">support@midwestfit.com</a> | <a href="{{ route('privacy') }}">Privacy Policy</a>	
					</p>	
				</div>	
			</div>
		</div>
	</footer>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.js"></script>

	<script type="text/javascript">
		$(function() {
			window.ZCPath = "{{ asset('ZeroClipboard.swf') }}";
		});
	</script>

    <script src="{{ elixir_cachebust('js/all.js') }}"></script>


</body>

</html>



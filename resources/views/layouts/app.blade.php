<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="">
<meta name="author" content="">

<title>{{ config('app.name', 'Smart Irrigation Web Console') }}</title>

<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">

<!-- Font Awesome -->
<link rel="stylesheet"
	href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet"
	href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">


<link rel="stylesheet"
	href="{{ asset('admin/dist/css/skins/skin-yellow-light.min.css') }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- jvectormap -->
<link rel="stylesheet"
	href="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">

<!-- Scripts -->
<script>
        window.Laravel = <?php
								
echo json_encode ( [ 
										'csrfToken' => csrf_token () 
								] );
								?>
    </script>
</head>
<body class="hold-transition skin-yellow-light sidebar-mini">
	<div id="app" class="wrapper">

		<header class="main-header">@include('layouts.navbar')</header>

		@if(! Auth::guest()) @include('layouts.sidebar') @endif

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>AIWC Dashboard</h1>

			</section>

			<!-- Main content -->
			<section class="content">
				@if ($message = session('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>{{ $message }}</strong>
				</div>
				@endif @if ($message = session('error'))
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>{{ $message }}</strong>
				</div>
				@endif @if ($message = session('warning'))
				<div class="alert alert-warning alert-block">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>{{ $message }}</strong>
				</div>
				@endif @if ($message = session('info'))
				<div class="alert alert-info alert-block">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>{{ $message }}</strong>
				</div>
				@endif @if ($errors->any())
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">x</button>
					Please check the form below for errors
				</div>
				@endif @yield('content')
			</section>
			<!-- /.content -->
		</div>
	</div>

	<!-- Scripts -->
	<!--     <script src="{{ asset('js/jquery.js') }}"></script> -->
	<!--     <script src="{{ asset('js/jquery.easing.min.js') }}"></script> -->
	<!--     <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->

	<!-- jQuery 2.2.3 -->
	<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('admin/dist/js/app.min.js') }}"></script>

	<script
		src="{{ asset('admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>

</body>
</html>

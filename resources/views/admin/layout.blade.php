<!DOCTYPE html>
<html>
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
	href="{{ asset('admin/dist/css/skins/skin-green-light.min.css') }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- Scripts -->
<script>
        window.Laravel = <?php
								
echo json_encode ( [ 
										'csrfToken' => csrf_token () 
								] );
								?>
    </script>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green-light sidebar-mini">
	<div class="wrapper">

		<!-- Main Header -->
		<header class="main-header">

			<!-- Logo -->
			<a href="{{ url('/admin/home') }}" class="logo"> <!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>A</b></span> <!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Admin</b></span>
			</a>

			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas"
					role="button"> <span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button --> <a href="#" class="dropdown-toggle"
							data-toggle="dropdown"> <!-- The user image in the navbar--> <img
								src="{{ asset('admin/dist/img/avatar.png') }}"
								class="user-image" alt="User Image"> <!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="hidden-xs">{{ Auth::guard('admin')->user()->username }}</span>
						</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header"><img
									src="{{ asset('admin/dist/img/avatar.png') }}"
									class="img-circle" alt="User Image">

									<p>{{ Auth::guard('admin')->user()->username }} - Adminisrator
									</p></li>

								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-right">
										<a href="{{ url('/admin/logout') }}"
											class="btn btn-default btn-flat"
											onclick="event.preventDefault();
                        document.getElementById('admin-logout-form').submit();">
											Log out </a>
										<form id="admin-logout-form"
											action="{{ url('/admin/logout') }}" method="POST"
											style="display: none;">{{ csrf_field() }}</form>
									</div>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">

			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">

				<!-- Sidebar user panel (optional) -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="{{ asset('admin/dist/img/avatar.png') }}"
							class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>{{ Auth::guard('admin')->user()->username }}</p>
						<!-- Status -->
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>



				<!-- Sidebar Menu -->
				<ul class="sidebar-menu">
					<li class="header">ACTIONS</li>
					<!-- Optionally, you can add icons to the links -->
					<li class="active"><a href="{{ url('/admin_area/soils') }}"><i
							class="fa fa-link"></i> <span>Add/Edit Soils</span></a></li>
					<li class="active"><a href="{{ url('/admin_area/systems') }}"><i
							class="fa fa-link"></i> <span>System Types</span></a></li>
					<li class="active"><a href="{{ url('/admin_area/plantgrp') }}"><i
							class="fa fa-link"></i> <span>Plant Groups</span></a></li>
					<li><a href="{{ url('/admin/regsys') }}"><i class="fa fa-link"></i>
							<span>View All Registered Systems</span></a></li>
					<li class="treeview"><a href="#"><i class="fa fa-link"></i> <span>Users</span>
							<span class="pull-right-container"> <i
								class="fa fa-angle-down pull-right"></i>
						</span> </a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/admin/add_irrigation') }}">Register
									Irrigation system</a></li>
							<li><a href="{{ url('/admin/all_users') }}">View All Users</a></li>
							<li><a href="#">Delete Irrigation System from User</a></li>
						</ul></li>
				</ul>
				<!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					SIWC Dashboard <small>Control Panel</small>
				</h1>

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
				@endif 
				@yield('content')

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="pull-right hidden-xs">AIWC</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2017 <a href="#">{{ config('app.name', 'Smart Irrigation Web Console') }}</a>.
			</strong> All rights reserved.
		</footer>


	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED JS SCRIPTS -->

	<!-- jQuery 2.2.3 -->
	<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('admin/dist/js/app.min.js') }}"></script>

	<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>

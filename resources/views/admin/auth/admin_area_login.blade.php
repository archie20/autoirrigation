<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Tell the browser to be responsive to screen width -->
<meta
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
	name="viewport">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="">
<meta name="author" content="">

<title>{{ config('app.name', 'Auto Irrigation Web Console') }}</title>


<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet"
	href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">

<!-- Scripts -->
<script>
        window.Laravel = <?php
								
echo json_encode ( [ 
										'csrfToken' => csrf_token () 
								] );
								?>
    </script>
</head>
<body>
	<div class="login-box">
		<div class="login-logo">
			<a href="{{ url('/') }}">{{ config('app.name', 'Auto Irrigation Web
				Console') }} (Admin)</a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Log in to start your session</p>

			<form action="{{ url('/admin/login') }}" method="post">
				{{ csrf_field() }}
				<div
					class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

					<input id="username" name="username" type="text"
						class="form-control" placeholder="Username" required autofocus> <span
						class="glyphicon glyphicon-user form-control-feedback"></span> @if
					($errors->has('username')) <span class="help-block"> <strong>{{
							$errors->first('username') }}</strong>
					</span> @endif

				</div>
				<div
					class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

					<input id="password" type="password" class="form-control"
						placeholder="Password" name="password" required> <span
						class="glyphicon glyphicon-lock form-control-feedback"></span> @if
					($errors->has('password')) <span class="help-block"> <strong>{{
							$errors->first('password') }}</strong>
					</span> @endif

				</div>
				<div class="row">

					<!-- /.col -->
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Log
							In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>


			<a href="{{ url('/admin_area/register') }}" class="text-center">Register
				as an Admin</a>

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- jQuery 2.2.3 -->
	<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
</body>
</html>

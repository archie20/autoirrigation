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
				<p>{{ Auth::user()->farmer_name }}</p>
			</div>
		</div>



		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">ACTIONS</li>
			<!-- Optionally, you can add icons to the links -->
			<li class="active"><a href="{{ url('/home') }}"><i class="fa fa-link"></i>
					<span>All My Systems</span></a></li>

		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>

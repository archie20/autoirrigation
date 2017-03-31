@extends('admin.layout') @section('content')


<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Users</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body no-padding">
		<table class="table table-striped">
			@if(! $usersList)
			<li>No users.</li> @else
			<tr>
				<th style="width: 70px">User ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Irrigation Systems</th>
			</tr>
			@foreach($usersList as $user)
			<tr>
				<td><a href="#">{{ $user['id'] }}</a></td>
				<td>{{ $user['farmer_name'] }}</td>
				<td>{{ $user['email'] }}</td>
				<td>{{ $user['systems_count'] }}</td>
			</tr>
			@endforeach @endif
		</table>
	</div>
	<!-- /.box-body -->
	<!--  <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
            -->
</div>
<!-- /.box -->


@endsection('content')

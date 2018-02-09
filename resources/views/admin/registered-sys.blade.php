@extends('admin.layout') @section('content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Registered Irrigation Systems</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table class="table table-bordered">
			@if(! $systems->count())
			<li>No soils added.</li> 
			@else
			<tr>
				<th style="width: 70px">Sys. ID</th>
				<th>Assigned Plant</th>
				<th>Location</th>
				<th style="width: 40px">Status</th>
				<th style="width: 70px">User ID</th>
			</tr>
			@foreach($systems as $system)
			<tr>
				<td>{{ $system->id }}</td>
				<td>{{ $system->plant_name }}</td>
				<td>{{ $system->device_location }}</td> 
				@if($system->isActivated)
				<td><span class="badge bg-green">ON</span></td>
				 @else
				<td><span class="badge bg-red">OFF</span></td> 
				@endif
				<td>{{ $system->Farmer_id }}</td>
			</tr>
			@endforeach 
			@endif
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

@extends('layouts.app') @section('content')
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Registered Irrigation Systems</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">

		@if(! $systems->count())
		<li>No Registered systems added. Contact the administrator to register one</li>
		@else
		<table class="table table-bordered">
			<tr>
				<th style="width: 70px">Sys. ID</th>
				<th>Assigned Plant</th>
				<th>Location</th>
				<th>Status</th>
				<th></th>
			</tr>
			@foreach($systems as $system)
			<tr>
				<td>{{ $system->id }}</td>
				<td>{{ $system->plant_name }}</td>
				<td>{{ $system->device_location }}</td> 
				@if($system->isActivated)
				<td><span class="badge bg-green">ACTIVATED</span></td>
				<td><a href="{{  url('/dash/system/'.$system->id) }}"
					class="btn btn-default btn-flat"> View </a></td> 
				@else
				<td><span class="badge bg-red">DEACTIVATED</span></td>
				<td><a class="btn btn-default btn-flat" disabled> View </a></td>
				@endif
			</tr>
			@endforeach
		</table>
		@endif

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
@endsection

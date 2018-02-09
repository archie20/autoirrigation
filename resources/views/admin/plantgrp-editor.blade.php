@extends('admin.layout') @section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Plant Groups</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body no-padding">
		<table class="table table-striped">
			<form action="{{ url('/admin/plantgrp') }}" method="post">
				{{ csrf_field() }}
				<tr>
					<div class="input-group input-group-sm">
						<td></td>
						<td><input id="group_name" name="group_name" type="text"
							class="form-control" placeholder="Plant Group" required></td>
						<td><input id="kc" name="kc" type="text"
							 class="form-control" placeholder="Plant Constant(Kc)"
							required></td>
						<td>
							<div class="col-xs-4">
								<button class="btn btn-primary" type="submit">Add</button>
							</div>
						</td>
					</div>
				</tr>
			</form>
			<tr>
				<th style="width: 10px"></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<th style="width: 10px">ID</th>
				<th>Group name</th>
				<th>Plant Constant(Kc)</th>
				<th></th>
			</tr>

			@if(! $plantGroups->count())
			<li>No plant groups added.</li> 
			@else 
				@foreach($plantGroups as $plantGroup)
			<form action="{{ url('/admin/plantgrp') }}" method="post">
				{{ csrf_field() }}
				<tr>
					<td><input id="pg_id" name="pg_id" type="text"
						style="width: 50px" value="{{ $plantGroup->id }}" readonly></td>
					<td><input id="group_name" name="group_name" type="text"
						class="form-control" value="{{ $plantGroup->group_name }}"></td>
					<td><input id="kc" name="kc"
						type="text" class="form-control"
						value="{{ $plantGroup->kc }}"></td>
					<td>
						<div class="col-xs-4">
							<button class="btn btn-primary" type="submit">Edit</button>
						</div>
					</td>
				</tr>
			</form>
			@endforeach 
		@endif
		</table>
	</div>

</div>
@endsection('content')

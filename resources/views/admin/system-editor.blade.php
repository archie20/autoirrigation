@extends('admin.layout') @section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">System Types</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body no-padding">
		<table class="table table-striped">
			<form action="{{ url('/admin/systems') }}" method="post">
				{{ csrf_field() }}
				<tr>
					<div class="input-group input-group-sm">
						<td></td>
						<td><input id="type" name="type" type="text"
							class="form-control" placeholder="System Type" required></td>
						<td><input id="p_rate" name="p_rate" type="text"
							 class="form-control" placeholder="Precipitation rate (in/hr)"
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
				<th>Type</th>
				<th>Precipitation rate(in/hr)</th>
				<th></th>
			</tr>

			@if(! $systemTypes->count())
			<li>No soils added.</li> 
			@else 
				@foreach($systemTypes as $systemType)
			<form action="{{ url('/admin/systems') }}" method="post">
				{{ csrf_field() }}
				<tr>
					<td><input id="systemType_id" name="systemType_id" type="text"
						style="width: 50px" value="{{ $systemType->id }}" readonly></td>
					<td><input id="type" name="type" type="text"
						class="form-control" value="{{ $systemType->type }}"></td>
					<td><input id="p_rate" name="p_rate"
						type="text" class="form-control"
						value="{{ $systemType->p_rate }}"></td>
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

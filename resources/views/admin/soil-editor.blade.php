@extends('admin.layout') @section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Soil Types</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body no-padding">
		<table class="table table-striped">
			<form action="{{ url('/admin/soils') }}" method="post">
				{{ csrf_field() }}
				<tr>
					<div class="input-group input-group-sm">
						<td></td>
						<td><input id="soil_name" name="soil_name" type="text"
							class="form-control" placeholder="Soil Name" required></td>
						<td><input id="threshold_value" name="threshold_value"
							type="number" class="form-control" placeholder="Threshold value"
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
				<th>Soil Name</th>
				<th>Threshold</th>
				<th></th>
			</tr>

			@if(! $soils->count())
			<li>No soils added.</li> @else @foreach($soils as $soil)
			<form action="{{ url('/admin/soils') }}" method="post">
				{{ csrf_field() }}
				<tr>
					<td><input id="soil_id" name="soil_id" type="text"
						style="width: 50px" value="{{ $soil->id }}" readonly></td>
					<td><input id="soil_name" name="soil_name" type="text"
						class="form-control" value="{{ $soil->soil_name }}"></td>
					<td><input id="threshold_value" name="threshold_value"
						type="number" class="form-control"
						value="{{ $soil->threshold_value }}"></td>
					<td>
						<div class="col-xs-4">
							<button class="btn btn-primary" type="submit">Edit</button>
						</div>
					</td>
				</tr>
			</form>
			@endforeach @endif
		</table>
	</div>

</div>
@endsection('content')

@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Details</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST"
						action="{{ url('/microcontroller/'. $irrSystem->id) }}">
						{{ csrf_field() }}
						<div class="form-group">
						<div>
							<label for="soils" class="col-md-4 control-label">Soil Type</label>
							<div class="col-md-6">
							<select class="textWidth form-control" name="soils" id="soilId"
								type="text" required>
								<option disabled selected>--- select soil ---</option>
								@foreach($soilTypes as $soilType)
								<option value="{{ $soilType->id }}">{{ $soilType->soil_name }}</option>
								@endforeach
							</select>
							</div>
						</div>
						</div>

						<div class="form-group">
							<div
								class="form-group{{ $errors->has('plant_name') ? ' has-error' : '' }}">
								<label for="plantName" class="col-md-4 control-label">Your crop
									name</label>

								<div class="col-md-6">
									<input id="plantName" type="text" class="form-control"
										name="plantName" value="{{ $irrSystem->plant_name }}" required
										autofocus> @if($errors->has('plant_name')) <span
										class="help-block"> <strong>{{ $errors->first('plant_name') }}</strong>
									</span> @endif
								</div>
							</div>
						</div>
					
						<div class="form-group">
							<div
								class="form-group{{ $errors->has('device_location') ? ' has-error' : '' }}">
								<label for="deviceLocation" class="col-md-4 control-label">Farm
									location</label>

								<div class="col-md-6">
									<input id="deviceLocation" type="text" class="form-control"
										name="deviceLocation" value="{{ $irrSystem->device_location }}"
										required> @if($errors->has('device_location')) <span
										class="help-block"> <strong>{{
											$errors->first('device_location') }}</strong>
									</span> @endif
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</div>
						<div>
							@if($irrSystem->isActivated)
							<a href="{{  url('/microcontroller/status/'.$irrSystem->id) }}" 
								class="btn btn-default btn-flat">Deactivate</a>
							<span class="badge bg-green">O</span>
							@else
							<a href="{{  url('/microcontroller/status/'.$irrSystem->id) }}" 
								class="btn btn-default btn-flat">Activate</a>
							<span class="badge bg-red">O</span>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

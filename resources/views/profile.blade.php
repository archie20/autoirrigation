@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Personal Info</div>

				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST"
						action="{{ url('/profile') }}">
						{{ csrf_field() }}

						<div class="form-group">
							<div
								class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Name</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name"
										value="{{ old('name') }}" required autofocus> 
										@if($errors->has('name')) 
										<span class="help-block"> <strong>{{ $errors->first('name') }}</strong>
									</span> 
									@endif
								</div>
							</div>
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</div>

					</form>
				</div>

				<!-- Microcontroller Editing -->
				<div class="panel-heading">Edit Microcontroller(s)</div>

				<div class="panel-body">
					@if (!$mControllers->count())
					<li>No registered irrigation systems detected.</li> 
					@else 
						@foreach($mControllers as $mController)
					<li><a class="btn btn-link" 
						href="{{ url('/microcontroller/'.$mController->id) }}">Registered system {{ $loop->index +1 }}</a></li> 
							@endforeach 
					@endif
				</div>
			</div>
			<!-- End Microcontroller Editing -->

		</div>
	</div>
</div>
@endsection

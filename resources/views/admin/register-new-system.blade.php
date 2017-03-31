@extends('admin.layout') @section('content')

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Register Irrigation System to User</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form role="form" action="{{ url('admin/add_irrigation') }}"
		method="post">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group">
				<label for="email">User Email address</label> <input type="email"
					class="form-control" id="email" name="email"
					placeholder="Enter user email" required autofocus>
			</div>

		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>
<!-- /.box -->

@endsection('content')

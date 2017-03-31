<?php
@if ($message = session('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = session('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = session('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = session('info'))
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($error->any())
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">x</button>
	Please check the form below for errors
</div>
@endif
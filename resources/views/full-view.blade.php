@extends('layouts.app') 
@section('content')
<div class="box">
	<div class="box-header with-border">
	@if($infoType === "moisture")
		<h3 class="box-title">Historical Moisture Readings</h3>
	@endif
	@if($infoType === "temp")
		<h3 class="box-title">Historical Temperature Readings</h3>
	@endif
	@if($infoType === "intrus")
		<h3 class="box-title">Historical Events</h3>
	@endif
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table class="table table-bordered">
			@if(! $data->count())
			<li>Nothing recorded yet!</li> 
			@else
			<tr>
				<th>Date</th>
				@if($infoType === "temp")
				<th>Reading (<sup style="font-size: 10px">o</sup>C)</th>
				@endif
				@if($infoType === "moisture")
				<th>Reading</th>
				@endif
				@if($infoType === "intrus")
				<th>Event</th>
				@endif
				@if($infoType != "intrus")
				<th style="width: 40px">Pump Status</th>
				@else
				<th style="width: 40px"> </th>
				@endif
			</tr>
			@foreach($data as $datum)
			<tr>
				<td>{{ $datum->time_recorded }}</td>
				@if($infoType === "moisture")
					<td>{{ $datum->moisture_value }}</td> 
				@endif
				@if($infoType === "temp")
					<td>{{ $datum->temp_reading }}</td>
				@endif
				@if($infoType === "intrus")
					<td>Intrusion detected!</td>
				@endif
				@if($infoType != "intrus" && $datum->pump_status)
				<td><span class="badge bg-green">ON</span></td>
				 @else
				<td><span class="badge bg-red">OFF</span></td> 
				@endif
				
			</tr>
			@endforeach 
			@endif
		</table>
	</div>
@endsection('content')
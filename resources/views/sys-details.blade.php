@extends('layouts.app') @section('content')
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('admin/plugins/chartjs/Chart.min.js') }}"></script>
<script>
 window.onload = function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------
    var areaChartCanvas = document.getElementById("areaChart").getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);
    var data = <?php echo $moist_vals?>;
    var datalabels = [], moist_values = [],temp_values=[];

    for(var i=0; i<data.length; i++){
		var myDate = new Date(data[i].time_recorded);
    	var fDate = myDate.getDate()+"-"+myDate.getHours();
        datalabels.push(fDate);
        moist_values.push(data[i].moisture_value);
        temp_values.push(data[i].temp_reading);
    }

    var areaChartData = {
    	      labels: datalabels,
    	      datasets: [
    	        {
    	          label: "Moisture levels",
    	          fillColor: "rgba(60,141,188,0.3)",
    	          strokeColor: "rgba(60,141,188,0.8)",
    	          pointColor: "#3b8bba",
    	          pointStrokeColor: "rgba(60,141,188,1)",
    	          pointHighlightFill: "#fff",
    	          pointHighlightStroke: "rgba(60,141,188,1)",
    	          data: moist_values
    	        }
    	      ]
    	    };
    	    

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.2,
      //Boolean - Whether to show a dot for each point
      pointDot: true,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };
  //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartData = {
    	      labels: datalabels,
    	      datasets: [
    	        {
    	          label: "Moisture Level",
    	          fillColor: "rgba(60,141,188,0.9)",
    	          strokeColor: "rgba(60,141,188,0.8)",
    	          pointColor: "#3b8bba",
    	          pointStrokeColor: "rgba(60,141,188,1)",
    	          pointHighlightFill: "#fff",
    	          pointHighlightStroke: "rgba(60,141,188,1)",
    	          data: moist_values
    	        },
    	        {
      	          label: "Temperature",
      	          fillColor: "rgba(255,0,0,0.9)",
      	          strokeColor: "rgba(255,0,0,0.8)",
      	          pointColor: "rgba(255,0,0,1)",
      	          pointStrokeColor: "rgba(255,0,0,1)",
      	          pointHighlightFill: "#fff",
      	          pointHighlightStroke: "rgba(255,0,0,1)",
      	          data: temp_values
      	        }
    	      ]
    	    };
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(lineChartData, lineChartOptions);
    
  };
</script>

<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>
					{{ $currentTemp }}<sup style="font-size: 30px">o</sup>C
				</h3>

				<p>Farm Temp</p>
			</div>
			<div class="icon">
				<i class="ion ion-bag"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i
				class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>
					{{ $rcnt_moist->moisture_value }}<sup style="font-size: 20px">%</sup>
				</h3>

				<p>Soil Moisture</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i
				class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				@if($system->pump_status)
				<h3>ON</h3>
				@else
				<h3>OFF</h3>
				@endif
				<p>Pump Status</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">Change <i
				class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>{{ $curr_weather }}</h3>

				<p>Weather Condition</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i
				class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
</div>



<!-- AREA CHART -->
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Recent 10 Soil Water readings</h3>

		<div class="box-tools pull-right">
			<div>
				<button type="button" class="btn btn-box-tool"
					data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="box-body">
		<div class="chart">
			<canvas id="areaChart" style="height: 200px"></canvas>
		</div>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

<!-- LINE CHART -->
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Recent 10 Soil Water vs Temperature readings</h3>

		<div class="box-tools pull-right">
			<div>
				<button type="button" class="btn btn-box-tool"
					data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="box-body">
		<div class="chart">
			<canvas id="lineChart" style="height: 200px"></canvas>
		</div>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->




@endsection('content')

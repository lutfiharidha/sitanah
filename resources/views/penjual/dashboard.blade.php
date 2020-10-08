@extends('layouts.appAuth')
@section('content')
	<div class="uk-width-expand">
		<div class="uk-card uk-card-default uk-card-small uk-card-hover">
			<div class="uk-card-header">
				<div class="uk-grid uk-grid-small">
					<div class="uk-width-auto"><h4>Penjualan Tanah</h4></div>
				</div>
			</div>
			<div class="uk-card-body">
				<div class="chart-container">
					<canvas id="chart1"></canvas>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script>
		var char1El = document.getElementById('chart1');
		new Chart(char1El, {
		type: 'bar',
		data: {
			labels: ["Approved", "Pending"],
			datasets: [{
			label: "Penjualan",
			backgroundColor: ["#39f", "#895df6"],
			data: [{{count($approved)}}, {{count($pending)}}]
			}]
		},
		
		options: {
			maintainAspectRatio: false,
			responsiveAnimationDuration: 500,
			legend: {
			display: false
			},
			animation: {
			duration: 2000
			},
			title: {
			display: true,
			text: 'Tanah Menurut Kota'
			},
			scales: {
				xAxes: [{
					display: true,
					gridLines : {
						display : false
					}
				}],
				yAxes: [{
					display: true,
					ticks: {
						beginAtZero: true,
						suggestedMax: 100,
						min: 0,
						stepSize: 20,
						callback: function(value) {if (value % 1 === 0) {return value;}}
						},
				}]
			},

		}
		});

		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
@endsection
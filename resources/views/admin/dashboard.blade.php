@extends('layouts.appAuth')
@section('content')
	<div class="uk-grid uk-grid-divider uk-grid-medium uk-child-width-1-2 uk-child-width-1-4@l uk-child-width-1-5@xl" data-uk-grid>
		<div>
			<span class="uk-text-small"><span data-uk-icon="icon:users" class="uk-margin-small-right uk-text-primary"></span>Penjual</span>
			<h1 class="uk-heading-primary uk-margin-remove  uk-text-primary">{{count($sellers)}}</h1>
		</div>
		<div>
			<span class="uk-text-small"><span data-uk-icon="icon:social" class="uk-margin-small-right uk-text-primary"></span>Tanah</span>
			<h1 class="uk-heading-primary uk-margin-remove uk-text-primary">{{count($tanah)}}</h1>
			
		</div>
		<div class="uk-text-center uk-width-expand">
			<h1 class="uk-margin-top uk-heading-primary uk-text-primary">{{ date('d-F-Y') }}<h1>
		</div>
	</div>
	<hr>
	<div class="uk-grid uk-grid-medium" data-uk-grid>
		<!-- panel -->
		<div class="uk-width-1-2@l">
			<div class="uk-card uk-card-default uk-card-small uk-card-hover">
				<div class="uk-card-header">
					<div class="uk-grid uk-grid-small">
						<div class="uk-width-auto"><h4>Tanah Terbaru</h4></div>
					</div>
				</div>
				<div class="uk-card-body">
					<table class="uk-table uk-table-striped">
						<thead>
							<tr>
								<th>Pemilik</th>
								<th>Kota</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($allTanah as $tanah)
								<tr class="uk-text-capitalize">
									<td>{{$tanah->tanah_has_penjual->penjual_has_user->name}}</td>
									<td>{{$tanah->kota}}</td>
									<td>{{$tanah->status}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /panel -->
		<!-- panel -->
		<div class="uk-width-1-2@l">
			<div class="uk-card uk-card-default uk-card-small uk-card-hover">
				<div class="uk-card-header">
					<div class="uk-grid uk-grid-small">
						<div class="uk-width-auto"><h4>Penjual Terbaru</h4></div>
					</div>
				</div>
				<div class="uk-card-body">
					<table class="uk-table uk-table-striped">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Kota</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($allPenjual as $penjual)
								<tr class="uk-text-capitalize">
									<td>{{$penjual->penjual_has_user->name}}</td>
									<td>{{$penjual->kota}}</td>
									<td>{{$penjual->penjual_has_user->status}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /panel -->
		<!-- panel -->
		<div class="uk-width-1-2@l">
			<div class="uk-card uk-card-default uk-card-small uk-card-hover">
				<div class="uk-card-header">
					<div class="uk-grid uk-grid-small">
						<div class="uk-width-auto"><h4>Data Tanah</h4></div>
					</div>
				</div>
				<div class="uk-card-body">
					<div class="chart-container">
						<canvas id="chart1"></canvas>
					</div>
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
			labels: ["Lhokseumawe", "Aceh Utara"],
			datasets: [{
			label: "Penjualan",
			backgroundColor: ["#39f", "#895df6"],
			data: [{{count($tanahLhok)}}, {{count($tanahAU)}}]
			}]
		},
		
		options: {
			maintainAspectRatio: false,
			responsiveAnimationDuration: 500,
			legend: {
			display: false
			},
			animation: {
			duration: 3000
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

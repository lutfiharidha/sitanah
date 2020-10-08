<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard - UIkit 3 KickOff</title>
		<!-- CSS FILES -->
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
		<link rel="stylesheet" type="text/css" href="{{url('css/dashboard.css')}}">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css">
        <link rel="stylesheet" href="{{url('css/uikit.min.css')}}">
        <!-- JS FILES -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.uikit.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

	</head>
	<body>

		<!--HEADER-->
		<header id="top-head" class="uk-position-fixed">
			<nav class="uk-navbar uk-light uk-background-primary uk-height-1-6" data-uk-navbar="mode:click; duration: 250">
				<div class="uk-navbar-left">
					<div class="uk-navbar-item uk-hidden@m">
						<a class="uk-logo" href="#"><img class="custom-logo" src="{{url('img/dashboard-logo-white.svg')}}" alt=""></a>
					</div>
				</div>
				<div class="uk-navbar-right uk-margin-right">
					<ul class="uk-navbar-nav">
						<li><a href="{{ route(auth()->user()->level.'.profile') }}" data-uk-icon="icon:user" title="Your profile" data-uk-tooltip></a></li>
						<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-uk-icon="icon:  sign-out" title="Sign Out" data-uk-tooltip></a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
						<li><a class=" uk-hidden@l uk-navbar-toggle" data-uk-toggle data-uk-navbar-toggle-icon href="#offcanvas-nav" title="Offcanvas" data-uk-tooltip></a></li>
					</ul>
				</div>
			</nav>
		</header>
		<!--/HEADER-->
		<!-- LEFT BAR -->
		<aside id="left-col" class="uk-light uk-visible@m">
			<div class="left-logo uk-flex uk-flex-middle uk-inline">
				<h3 class="uk-position-center">TanahKu</h3>
			</div>
			<div class="left-content-box  content-box-dark">
				<img src="{{url('img/avatar.svg')}}" alt="" class="uk-border-circle profile-img">
				<h4 class="uk-text-center uk-margin-remove-vertical text-light">{{auth()->user()->name}}</h4>
				
				<div class="uk-position-relative uk-text-center uk-display-block">
				    <a href="#" class="uk-text-small uk-text-muted uk-display-block uk-text-center uk-text-capitalize" data-uk-icon="icon: triangle-down; ratio: 0.7">{{auth()->user()->level}}</a>
				    <!-- user dropdown -->
				    <div class="uk-dropdown user-drop" data-uk-dropdown="mode: click; pos: bottom-center; animation: uk-animation-slide-bottom-small; duration: 150">
				    	<ul class="uk-nav uk-dropdown-nav uk-text-left">
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Sign Out</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
					    </ul>
				    </div>
				    <!-- /user dropdown -->
				</div>
			</div>
			@if(auth()->user()->status == 'approved')
			<div class="left-nav-wrap">
				<ul class="uk-nav uk-nav-default uk-nav-parent-icon" data-uk-nav>
					<li class="uk-nav-header">ACTIONS</li>
					@if(auth()->user()->level == 'penjual')
                    <li><a href="{{route('dashboardPenjual')}}"><span data-uk-icon="icon: home" class="uk-margin-small-right"></span>Dashboard</a></li>
					@else
                    <li><a href="{{route('dashboardAdmin')}}"><span data-uk-icon="icon: home" class="uk-margin-small-right"></span>Dashboard</a></li>
					<li><a href="{{route('dataAdmin')}}"><span data-uk-icon="icon: user" class="uk-margin-small-right"></span>Admin</a></li>
					@endif
					<li class="uk-parent"><a href="#"><span data-uk-icon="icon: thumbnails" class="uk-margin-small-right"></span>Data Tanah</a>
						<ul class="uk-nav-sub">
							@if(auth()->user()->level == 'penjual')
							<li><a title="Data Tanah" href="{{route('indexTanah')}}">Data Tanah</a></li>
							<li><a title="Add Data Tanah" href="{{route('addTanah')}}">Tambah Tanah</a></li>
							@else
							<li><a title="Article" href="{{route('indexAdminTanah')}}">Verifikasi</a></li>
							<li><a title="Album" href="{{route('indexAdminTanahUn')}}">Belum Verifikasi</a></li>
							<li><a title="Album" href="{{route('indexAdminTanahBan')}}">Banned</a></li>
							@endif
						</ul>
					</li>
					@if(auth()->user()->level == 'admin')
					<li class="uk-parent"><a href="#"><span data-uk-icon="icon: thumbnails" class="uk-margin-small-right"></span>Data Penjual</a>
						<ul class="uk-nav-sub">
							<li><a title="Article" href="{{route('indexPenjual')}}">Verifikasi</a> </li>
							<li><a title="Album" href="{{route('indexPenjualUn')}}">Belum Verifikasi</a></li>
							<li><a title="Album" href="{{route('indexPenjualBan')}}">Banned</a></li>
						</ul>
					</li>
					@endif
				</ul>
			</div>
			@endif
		</aside>
		<!-- /LEFT BAR -->
		<!-- CONTENT -->
		<div id="content" data-uk-height-viewport="expand: true">
			<div class="uk-container uk-padding uk-container-expand">
				@if (\Session::has('success'))
					<div class="uk-alert-success uk-position-relative uk-position-small uk-position-top-center" uk-alert="duration:300; animation:true">
						<a class="uk-alert-close" uk-close></a>
						<p>{!! \Session::get('success') !!}</p>
					</div>
				@endif
				@if(auth()->user()->status == 'approved')
					@yield('content')
				@elseif(auth()->user()->status == 'banned')
					<h1 class="uk-text-center">Akun Bermasalah Dikarenakan</h1>
					<h3 class="uk-text-center">{{auth()->user()->message}}</h3>
				@else
					<h1 class="uk-text-center">Akun Belum Di Approve</h1>
					<h3 class="uk-text-center">Tunggu 2 - 3 hari kerja</h3>
				@endif
				<footer class="uk-section uk-section-small uk-text-center">
					<hr>
					<p class="uk-text-small uk-text-center">Copyright {{date('Y')}} - <a href="https://github.com/zzseba78/Kick-Off">Created by KickOff</a> | Built with <a href="http://getuikit.com" title="Visit UIkit 3 site" target="_blank" data-uk-tooltip><span data-uk-icon="uikit"></span></a> </p>
				</footer>
			</div>
		</div>
		<!-- /CONTENT -->
        <!-- OFFCANVAS -->
		<div id="offcanvas-nav" data-uk-offcanvas="flip: true; overlay: true">
			<div class="uk-offcanvas-bar uk-offcanvas-bar-animation uk-offcanvas-slide">
				<button class="uk-offcanvas-close uk-close uk-icon" type="button" data-uk-close></button>
				<div class="left-logo uk-flex uk-flex-middle uk-inline">
					<h3 class="uk-position-center">TanahKu</h3>
				</div>
				<div class="left-content-box">
					<img src="{{url('img/avatar.svg')}}" alt="" class="uk-border-circle profile-img">
					<h4 class="uk-text-center uk-margin-remove-vertical text-light">{{auth()->user()->name}}</h4>
					
					<div class="uk-position-relative uk-text-center uk-display-block">
						<a href="#" class="uk-text-small uk-text-muted uk-display-block uk-text-center uk-text-capitalize" data-uk-icon="icon: triangle-down; ratio: 0.7">{{auth()->user()->level}}</a>
						<!-- user dropdown -->
						<div class="uk-dropdown user-drop" data-uk-dropdown="mode: click; pos: bottom-center; animation: uk-animation-slide-bottom-small; duration: 150">
							<ul class="uk-nav uk-dropdown-nav uk-text-left">
							<li><a class="uk-text-danger" href="{{ route('logout') }}"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								<span data-uk-icon="icon: sign-out"></span> Sign Out</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
							</ul>
						</div>
						<!-- /user dropdown -->
					</div>
				</div>
			@if(auth()->user()->status == 'approved')
				
				<div class="left-nav-wrap">
                    <ul class="uk-nav uk-nav-default uk-nav-parent-icon" data-uk-nav>
                        <li class="uk-nav-header">ACTIONS</li>
                        <li><a href="#"><span data-uk-icon="icon: home" class="uk-margin-small-right"></span>Dashboard</a></li>
						<li class="uk-parent"><a href="#"><span data-uk-icon="icon: thumbnails" class="uk-margin-small-right"></span>Data Tanah</a>
							<ul class="uk-nav-sub">
								@if(auth()->user()->level == 'penjual')
									<li><a title="Data Tanah" href="{{route('indexTanah')}}">Data Tanah</a></li>
									<li><a title="Add Data Tanah" href="{{route('addTanah')}}">Tambah Tanah</a></li>
								@else
									<li><a title="Article" href="{{route('indexAdminTanah')}}">Verifikasi</a></li>
									<li><a title="Album" href="{{route('indexAdminTanahUn')}}">Belum Verifikasi</a></li>
									<li><a title="Album" href="{{route('indexAdminTanahBan')}}">Banned</a></li>
								@endif
							</ul>
						</li>
						<li class="uk-parent"><a href="#"><span data-uk-icon="icon: thumbnails" class="uk-margin-small-right"></span>Data Penjual</a>
							<ul class="uk-nav-sub">
								<li><a title="Article" href="{{route('indexPenjual')}}">Verifikasi</a></li>
								<li><a title="Album" href="{{route('indexPenjualUn')}}">Belum Verifikasi</a></li>
								<li><a title="Album" href="{{route('indexPenjualBan')}}">Banned</a></li>
							</ul>
						</li>
						<li><a href="#"><span data-uk-icon="icon: lifesaver" class="uk-margin-small-right"></span>Reports</a></li>
					</ul>
					
				</div>
				@endif
			</div>
		</div>
		<!-- /OFFCANVAS -->
		
		<!-- JS FILES -->
		<script>
			$('.show_confirm').click(function(e) {
				if(!confirm('Are you sure you want to delete this?')) {
					e.preventDefault();
				}
			});
		</script>
		<script src="{{asset('js/uikit.min.js')}}"></script>
		<script src="{{asset('js/uikit-icons.min.js')}}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
        <script src="{{url('js/chartScripts.js')}}"></script>
		@yield('script')
	</body>
</html>
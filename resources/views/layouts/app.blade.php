<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}">
    <script src="{{ asset('js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/uikit-icons.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body style="background:#E9E9E9">
    <header>
        <nav class="uk-margin uk-text-capitalize uk-background-primary" uk-navbar>
            <div class="uk-navbar-left uk-margin-left">
                <a class="uk-navbar-item uk-logo uk-text-white" href="{{ route('beranda') }}">TanahKu</a>
                <ul class="uk-navbar-nav">
                    <li><a id="btnAction" class="uk-button uk-button-link uk-text-white uk-text-capitalize"><span uk-icon="icon:location; ratio:1"></span> Lokasi Terdekat</a></li>
                    @guest
                        <li><a class="uk-text-white uk-text-capitalize uk-hidden@l" href="{{route('login')}}">Daftar</a></li>
                        @else
                        @if (auth()->user()->level == 'admin')
                            <li><a class="uk-text-white uk-text-capitalize uk-hidden@l" href="{{route('dashboardAdmin')}}">Dashboard</a></li>
                            @else
                            <li><a class="uk-text-white uk-text-capitalize uk-hidden@l" href="{{route('dashboardPenjual')}}">Dashboard</a></li>
                        @endif   
                    @endguest
                </ul>    
            </div>
            
            <div class="uk-navbar-right uk-margin-right uk-visible@l">
                <ul class="uk-navbar-nav">
                    @guest
                        <li><a class="uk-text-white uk-text-capitalize" href="{{route('login')}}">Masuk / Daftar</a></li>
                        @else
                        @if (auth()->user()->level == 'admin')
                            <li><a class="uk-text-white uk-text-capitalize" href="{{route('dashboardAdmin')}}">Dashboard</a></li>
                            @else
                            <li><a class="uk-text-white uk-text-capitalize" href="{{route('dashboardPenjual')}}">Dashboard</a></li>
                            <li><a class="uk-text-white uk-text-bold" href="{{route('addTanah')}}">Pasang Iklan</a></li>
                        @endif   
                    @endguest
                </ul>    
            </div>
        </nav>
    </header>
    <div class="uk-padding-small">
        @yield('content')
    </div>
    <div class="uk-background-secondary uk-light" id="footer"  uk-height-viewport="offset-bottom: 60">
        <div class="uk-padding uk-child-width-1-2@m  uk-text-center" uk-grid>
            <div>
                <h4 class="uk-text-center">
                    <a href="{{ route('tanahKota', 'lhokseumawe') }}">Daerah Lhokseumawe </a>
                </h4>
                <p>
                    <a href="{{ route('tanahKecamatan', 'banda-sakti') }}">Banda Sakti</a>,
                    <a href="{{ route('tanahKecamatan', 'blang-mangat') }}">Blang Mangat</a>, 
                    <a href="{{ route('tanahKecamatan', 'muara-dua') }}">Muara Dua</a>, 
                    <a href="{{ route('tanahKecamatan', 'muara-satu') }}">Muara Satu</a>
                </p>
            </div>
            <div>
                <h4 class="uk-text-center">
                    <a href="{{ route('tanahKota', 'aceh-utara') }}">Daerah Aceh Utara</a>
                </h4>
                <p> 
                    <a href="{{ route("tanahKecamatan", "baktiya") }}">Baktiya</a>, 
                    <a href="{{ route("tanahKecamatan", "baktiya-barat") }}">Baktiya Barat</a>, 
                    <a href="{{ route("tanahKecamatan", "banda-baro") }}">Banda Baro</a>, 
                    <a href="{{ route("tanahKecamatan", "cot-girek") }}">Cot Girek</a>, 
                    <a href="{{ route("tanahKecamatan", "dewantara") }}">Dewantara</a>, 
                    <a href="{{ route("tanahKecamatan", "geuredong-pase") }}">Geuredong Pase</a>, 
                    <a href="{{ route("tanahKecamatan", "kuta-makmur") }}">Kuta Makmur</a>, 
                    <a href="{{ route("tanahKecamatan", "langkahan") }}">Langkahan</a>, 
                    <a href="{{ route("tanahKecamatan", "lapang") }}">Lapang</a>, 
                    <a href="{{ route("tanahKecamatan", "lhoksukon") }}">Lhoksukon</a>, 
                    <a href="{{ route("tanahKecamatan", "matangkuli") }}">Matangkuli</a>, 
                    <a href="{{ route("tanahKecamatan", "meurah-mulia") }}">Meurah Mulia</a>, 
                    <a href="{{ route("tanahKecamatan", "muara-batu") }}">Muara Batu</a>, 
                    <a href="{{ route("tanahKecamatan", "nibong") }}">Nibong</a>, 
                    <a href="{{ route("tanahKecamatan", "nisam") }}">Nisam</a>, 
                    <a href="{{ route("tanahKecamatan", "nisam-antara") }}">Nisam Antara</a>, 
                    <a href="{{ route("tanahKecamatan", "paya-bakong") }}">Paya Bakong</a>, 
                    <a href="{{ route("tanahKecamatan", "pirak-timur") }}">Pirak Timur</a>, 
                    <a href="{{ route("tanahKecamatan", "samudera") }}">Samudera</a>, 
                    <a href="{{ route("tanahKecamatan", "sawang") }}">Sawang</a>, 
                    <a href="{{ route("tanahKecamatan", "seunuddon-(seunudon)") }}">Seunuddon (Seunudon)</a>, 
                    <a href="{{ route("tanahKecamatan", "simpang-kramat-(keramat)") }}">Simpang Kramat (Keramat)</a>, 
                    <a href="{{ route("tanahKecamatan", "syamtalira-aron") }}">Syamtalira Aron</a>, 
                    <a href="{{ route("tanahKecamatan", "syamtalira-bayu") }}">Syamtalira Bayu</a>, 
                    <a href="{{ route("tanahKecamatan", "tanah-jambo-aye") }}">Tanah Jambo Aye</a>, 
                    <a href="{{ route("tanahKecamatan", "tanah-luas") }}">Tanah Luas</a>, 
                    <a href="{{ route("tanahKecamatan", "tanah-pasir") }}">Tanah Pasir</a>
                </p>
            </div>
        </div>
    </div>
    @yield('script')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        $(document).ready(function() {
            $("#btnAction").click(function() {
                if ("geolocation" in navigator){
                navigator.geolocation.getCurrentPosition(function(position){ 
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                        window.location.href = "http://10.0.2.2:8000/tanah/terdekat/"+lat+"/"+lng
    
            });
            }
        });
    });
    </script>
</body>
</html>
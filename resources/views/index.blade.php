<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/uikit.min.css">
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</head>
<body>
    <div class="uk-margin-medium-bottom" style="background: url(img/section1.jpg); background-repeat: no-repeat; background-position: center;" uk-height-viewport="offset-top: true">
        <nav class="uk-navbar-container uk-margin uk-text-capitalize" style="background: rgba(0, 0, 0, 0.5);" uk-navbar>
            <div class="uk-navbar-left uk-margin-left">
                <a class="uk-navbar-item uk-logo uk-text-white" href="{{ route('beranda') }}">TanahKu</a>
                <ul class="uk-navbar-nav">
                    {{-- <li><a  class="uk-text-white uk-text-capitalize" href="#">Dijual</a></li> --}}
                    <!-- <li><a class="uk-text-white uk-text-capitalize" href="#">Disewakan</a></li> -->
                    <li><a class="uk-text-white uk-text-capitalize" id="btnAction"><span uk-icon="icon:location; ratio:1"></span> Lokasi Terdekat</a></li>
                    @guest
                        <li><a class="uk-text-white uk-text-capitalize uk-hidden@l" href="{{route('login')}}">Daftar</a></li>
                    @else
                        @if (auth()->user()->level == 'admin')
                            <li><a class="uk-text-white uk-text-capitalize uk-hidden@l" href="{{route('dashboardAdmin')}}">Dashboard</a></li>
                        @else
                            <li><a class="uk-text-white uk-text-capitalize uk-hidden@l" href="{{route('dashboardPenjual')}}">Dashboard</a></li>
                            <li><a class="uk-text-white uk-text-bold uk-hidden@l" href="{{route('addTanah')}}">Pasang Iklan</a></li>
                        @endif   
                    @endguest
                </ul>    
            </div>

            <div class="uk-navbar-right uk-margin-right uk-visible@l">
                <ul class="uk-navbar-nav">
                    @guest
                        <li><a class="uk-text-white uk-text-capitalize " href="{{route('login')}}">Masuk / Daftar</a></li>
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
        <div class="uk-position-center uk-position-large">
            <div class="uk-card uk-card-body uk-border-rounded" style="background: rgba(255, 255, 255, 0.5);">
                <p class="uk-h3">Cari Properti?</p>
                <form action="{{ route('search') }}" method="get">
                    <input class="uk-input uk-margin" name="search" type="text" placeholder="Masukan lokasi atau nama pemilik tanah">
                    <button type="submit" class="uk-align-right uk-button uk-button-primary"><span uk-icon="icon: search; ratio: 1.2"></span> Search</button>
                </form>
            </div>
        </div>
        <div class="uk-animation-toggle" tabindex="0">
            <a href="#sec1" uk-scroll class="uk-animation-slide-top">
                <div class="uk-position-bottom-center uk-position-small">
                    <span uk-icon="icon: chevron-down; ratio:3;" class="uk-light"></span>
                </div>
                <div class="uk-position-bottom-center uk-position-medium">
                    <span uk-icon="icon: chevron-down; ratio:3;" class="uk-light"></span>
                </div>
            </a>
        </div>
    </div>
    <div class="uk-background-muted" id="sec1">
        @if (!@empty($tanahSatu))
        <div class="uk-container uk-text-capitalize">
            <div class="uk-text-center">
                <p><span class="uk-h4">Properti Terbaru</span> <a class="uk-text-center uk-button uk-button-text uk-text-capitalize" href="">(Lihat 120 Properti Terbaru)</a></p>
            </div>
            <div class="uk-align-center">
                <div class="uk-card uk-card-body uk-border-rounded uk-visible@l" style="background: url(img/section2.jpg); background-repeat: no-repeat; background-position: center;">
                    <div class="uk-margin-right uk-border-rounded uk-width-1-2 uk-card uk-card-default uk-card-body uk-align-right">
                            <h3 class="uk-card-title">{{ $tanahSatu->title }}</h3>
                            <p>Oleh <span class="uk-text-bold">{{ $tanahSatu->tanah_has_penjual->penjual_has_user->name }}</span></p>
                            <hr>
                            <span uk-icon="icon:location; ratio:1.2"></span> {{ $tanahSatu->kota }}
                            <p>Di <span class="uk-text-bold">{{ $tanahSatu->jenis }}</span></p>
                            <p>Luas Properti <span class="uk-text-bold uk-text-lowercase">{{ $tanahSatu->luas }} m<sup>2</sup></span></p>
                            <p>Harga Properti <span class="uk-text-bold">{{ $tanahSatu->harga }}</span></p>
                            <a class="uk-width-1 uk-button uk-button-default uk-align-center" href="{{ route('tanahShow', $tanahSatu->slug) }}">Lihat Info</a>
                        </div>
                    </div>
                </div>
                <div class="uk-border-rounded uk-card uk-card-default uk-card-body uk-hidden@l">
                    <h3 class="uk-card-title">{{ $tanahSatu->title }}</h3>
                    <p>Oleh <span class="uk-text-bold">{{ $tanahSatu->tanah_has_penjual->penjual_has_user->name }}</span></p>
                    <hr>
                    <span uk-icon="icon:location; ratio:1.2"></span> {{ $tanahSatu->kota }}
                    <p>Di <span class="uk-text-bold">{{ $tanahSatu->jenis }}</span></p>
                    <p>Luas Properti <span class="uk-text-bold uk-text-lowercase">{{ $tanahSatu->luas }} m<sup>2</sup></span></p>
                    <p>Harga Properti <span class="uk-text-bold">{{ $tanahSatu->harga }}</span></p>
                    <a class="uk-width-1 uk-button uk-button-default uk-align-center" href="{{ route('tanahShow', $tanahSatu->slug) }}">Lihat Info</a>
                </div>
            </div>
            </div>
        @endif
        <div class="uk-container uk-container-small uk-margin-large-top">
            <div uk-slider="autoplay: true;">
                <div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1">
                    <ul class="uk-slider-items uk-child-width-1-2@s uk-grid">
                        @foreach ($tanahLima as $tanah)
                        <li>
                            <div class="uk-card">
                                <a href="{{ route('tanahShow', $tanah->slug) }}">
                                    <div class="uk-inline propertyHome" >
                                    <img src="{{url('img/tanah',$tanah->tanah_has_foto[0]->foto)}}" class="propertyHome" alt="">
                                    <div class="uk-overlay uk-light uk-position-bottom">
                                        <h3>{{ $tanah->title }}</h3>
                                        <p>Oleh <span class="uk-text-bold">{{ $tanah->tanah_has_penjual->penjual_has_user->name }}</span></p>
                                        <p><span uk-icon="icon:location; ratio:1.2"></span> <span class="uk-text-bold">{{ $tanah->kota }}</span></p>
                                    </div>
                                </a>
                                </div>
                                <div class="uk-card-body">
                                    <p>Di <span class="uk-text-bold">{{ $tanah->jenis }}</span></p>
                                    <p>Luas Properti <span class="uk-text-bold uk-text-lowercase">{{ $tanah->luas }} m<sup>2</sup></span></p>
                                    <p>Harga Properti <span class="uk-text-bold">{{ $tanah->harga }}</span></p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
            
                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
            
                </div>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
            </div>
        </div>
        <div class="uk-container uk-container-small uk-margin-large-top uk-margin-large-bottom">
            <h4 class="uk-text-center">Informasi Wilayah</h4>
            <div class="uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body" style="background: url(img/lhokseumawe.jpg); background-repeat: no-repeat; background-position: center;">
                        <div class="uk-overlay-primary uk-position-cover"></div>
                        <div class="uk-overlay uk-light">
                            <p class="uk-position-center"><a href="{{ route('tanahKota', 'lhokseumawe') }}" class="uk-button uk-button-default">Lhokseumawe</a></p>
                        </div>
                    </div>
                </div>
                <div class="uk-border-rounded">
                    <div class="uk-card uk-card-default uk-card-body" style="background: url(img/acehutara.jpg); background-repeat: no-repeat; background-position: center; background-size: cover;">
                        <div class="uk-overlay-primary uk-position-cover"></div>
                        <div class="uk-overlay uk-light">
                            <p class="uk-position-center"><a href="{{ route('tanahKota', 'aceh-utara') }}" class="uk-button uk-button-default">Aceh Utara</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-container uk-container-small uk-align-center uk-margin-large-bottom">
            <div class="uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
                <div>
                    <div class="uk-border-rounded uk-card uk-card-secondary uk-card-body">
                        <img class="uk-comment-avatar rounded" src="img/feed1.jpg" alt="">
                        <a class="uk-link-reset uk-h4" href="#"> Muzakkir</a>
                        <p class="uk-text-center">Saya pilih TanahKu karena dari hasil search google TanahKu adalah situs properti terbaik di Indonesia. Selain itu, sangat membantu saya dalam mendapatkan database konsumen.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-border-rounded uk-card uk-card-secondary uk-card-body">
                        <img class="uk-comment-avatar rounded" src="img/feed2.jpg" alt="">
                        <a class="uk-link-reset uk-h4" href="#"> Ismail</a>
                        <p class="uk-text-center">TanahKu itu bagus, saya sangat terbantu karena banyak orang mencari properti di TanahKu. Banyak klien yang menghubungi dan sudah berhasil 3 kali closing dari TanahKu, yang terakhir merupakan tanah senilai 30 M.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-background-secondary uk-light">
        <div class="uk-padding uk-child-width-1-2@m uk-text-center" uk-grid>
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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
    $(document).ready(function()
        {
            var defer = $.Deferred();

        $('#btnAction').click(function(e) {
            if ("geolocation" in navigator){
            navigator.geolocation.getCurrentPosition(function(position){ 
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                window.location.href = "http://127.0.0.1:8000/tanah/terdekat/"+lat+"/"+lng

        });
        }
    });
});
</script>
</body>
</html>
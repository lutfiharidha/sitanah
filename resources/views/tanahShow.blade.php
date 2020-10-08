@extends('layouts.app')
@section('content')
<div>
  <ul class="uk-breadcrumb">
    <li><a href="{{ route('beranda') }}">Halaman Utama</a></li>
    <li><a href="{{ route('tanahKota', strtolower(str_replace(" ", "-", $tanah->kota))) }}">{{$tanah->kota}}</a></li>
    <li><a href="{{ route('tanahKecamatan', strtolower(str_replace(" ", "-", $tanah->kecamatan))) }}">{{$tanah->kecamatan}}</a></li>
    <li><span>{{$tanah->title}}</span></li>
  </ul>
</div>
  <p class="uk-text-capitalize">
    <span class="uk-h3">{{$tanah->title}}</span><br>
    <span uk-icon="icon:location"></span>
    {{$tanah->alamat}}, {{$tanah->kota}}, {{$tanah->kecamatan}}
  </p>
  <div class="uk-child-width-1-2@m " uk-grid>
    <div class="uk-width-2-3@m uk-align-center">
      <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: pull">
        <ul class="uk-slideshow-items">
            @foreach ($tanah->tanah_has_foto as $foto)
            <li>
              <div class="bg-tanah" style="background: url('{{url('img/tanah',$foto->foto)}}') no-repeat; background-size: cover;">
              </div>
                <img class="foto-tanah" src="{{url('img/tanah',$foto->foto)}}" alt="">
            </li>
            @endforeach
        </ul>
        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
      </div>
      <div class=" uk-margin uk-child-width-1-2@m uk-text-center" uk-grid>
        <p>HARGA <br><span class="uk-h4">{{$tanah->harga}}</span></p>
        <p>LUAS <br><span class="uk-h4 uk-lowercase">{{$tanah->luas}} m<sup>2</sup></span></p>
      </div>
      <div class="uk-card uk-card-default uk-card-body">
        <h4>Details</h4>
        <p class="uk-text-capitalize">
          <span class="uk-text-bold">Alamat: </span>{{$tanah->alamat}}, {{$tanah->kota}}, {{$tanah->kecamatan}}<br>
          <span class="uk-text-bold">Harga: </span>{{$tanah->harga}}<br>
          <span class="uk-text-bold">Status: </span> {{$tanah->jenis}}<br>
          <span class="uk-text-bold">Sertifikat: </span> {{$tanah->sertifikat}}<br>
          <span class="uk-text-bold">Pemilik: </span>{{$tanah->tanah_has_penjual->penjual_has_user->name}}<br>
          @if ($tanah->status != 'sold')
          <span class="uk-text-bold">Telepon: </span>{{$tanah->tanah_has_penjual->no_telp}}<br>
          @endif
        </p>
        <hr>
        <h4>Deskripsi</h4>
        <p>{!! $tanah->description !!}</p>
        <hr>
        <div id="right-panel">
          <h4>Results</h4>
          <ul id="places" class="uk-child-width-1-2@m" uk-grid></ul>
        </div>
        <hr>
        <h4>Lokasi</h4>
        <div id="map" style="clear:both; height:400px;"></div> 
        <hr>
        <h4>Tanah Lain Dari {{$tanah->tanah_has_penjual->penjual_has_user->name}}</h4>
        @foreach ($anotherTanah as $tanahl)
          <div class="uk-grid-collapse uk-child-width-1-2@m uk-margin" uk-grid>
            <div class="uk-width-1-3@m">
                <img src="{{url('img/tanah',$tanahl->tanah_has_foto[0]->foto)}}" alt="">
            </div>
            <div class="uk-width-expand@m uk-text-capitalize">
                <div class="uk-padding-small">
                    <h3 class="uk-card-title">{{ $tanahl->title }}</h3>
                    <span uk-icon="icon:location"></span>
                    <span class="uk-text-small">{{$tanah->alamat}}, {{$tanah->kota}}, {{$tanah->kecamatan}}</span>
                    <p>
                      <span>{{ $tanahl->harga }}</span><br>
                      <span class="uk-text-lowercase">{{ $tanahl->luas }} m<sup>2</sup></span>
                      <span class="uk-align-right"><a href="{{ route('tanahShow', $tanahl->slug) }}" class="uk-button uk-button-default">More Info</a></span>
                    </p>
                </div>
                  
            </div>
        </div>
      @endforeach
      </div>
    </div>
    <div class="uk-width-expand@m">
      <div class="uk-card uk-card-default" uk-sticky="offset: 50;bottom: true">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-auto@m">
                    <img class="uk-border-circle" width="70" height="70" src="https://static-id.lamudi.com/static/media/bm9uZS9ub25l/80x80/bd6ccc045d88ef.jpg">
                </div>
                <div class="uk-width-expand@m">
                  <h3 class="uk-text-primary uk-card-title uk-margin-remove-bottom">{{$tanah->tanah_has_penjual->penjual_has_user->name}}</h3>
                    
                </div>
              </div>
          </div>
          <div class="uk-card-body">
            <p class="uk-h3 uk-margin-remove-top">
              Anda perlu properti ini? 
            </p>
            <p class="uk-h3 uk-margin-remove-top">
               @if ($tanah->status == 'sold')
               <h4 class="uk-text-danger uk-text-bold">TANAH SUDAH TERJUAL</h4>
                  @else
                  Hubungi {{$tanah->tanah_has_penjual->no_telp}}
              @endif
            </p>
          </div>
          {{-- <div class="uk-card-footer">
            <form>
              <fieldset class="uk-fieldset">
          
                  <legend class="uk-legend uk-text-center">Tanya tentang properti ini</legend>
          
                  <div class="uk-margin">
                      <input class="uk-input" type="text" placeholder="Nama Lengkap">
                  </div>
                  <div class="uk-margin">
                    <input class="uk-input" type="text" placeholder="No Handphone">
                </div>
                <div class="uk-margin">
                  <input class="uk-input" type="text" placeholder="Email">
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-align-center">Kontak Penjual</button>
                </div>
              </fieldset>
            </form>
          </div> --}}
      </div>
  </div>
</div>
@endsection
@section('script')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5BFabnl0V1G4W-PBoEKpNC5xNISuZ2xE&callback=initMap&libraries=places&v=weekly"
  defer
></script>
<script>
  "use strict";
  function initMap() {
    const pyrmont = {
        lat: {{ empty($overlays[0]->lat) ? $tanah->lat : $overlays[0]->lat}}, 
        lng: {{ empty($overlays[0]->lng)? $tanah->lng : $overlays[0]->lng}} 
      };
    const map = new google.maps.Map(document.getElementById("map"), {
      center: pyrmont,
      zoom: 18,
      mapTypeId: 'satellite'
    }); 
    
    var goldenGatePosition= {lat: {{ empty($overlays[0]->lat)? $tanah->lat : $overlays[0]->lat}}, lng: {{ empty($overlays[0]->lng) ? $tanah->lng : $overlays[0]->lng}} }
    var marker = new google.maps.Marker({
      position: goldenGatePosition,
      map: map,
      optimized: false,
      animation: google.maps.Animation.DROP
      });
    var outerCoords = [
      @foreach($overlays as $overlay)
      {lat: {{ $overlay->lat }}, lng: {{ $overlay->lng }}},
      @endforeach
    ];

  var mypolygon = new google.maps.Polygon({
      paths: outerCoords,
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 3,
      fillColor: '#FF0000',
      fillOpacity: 0.35
    });

    mypolygon.setMap(map);
    const service = new google.maps.places.PlacesService(map);
        let getNextPage;
        service.nearbySearch(
          {
            location: pyrmont,
            radius: 500,
            rankby : google.maps.places.RankBy.DISTANCE
          },
          (results, status, pagination) => {
            if (status !== "OK") return;
            createMarkers(results, map);

          }
        );
  }
  function createMarkers(places, map) {
    const bounds = new google.maps.LatLngBounds();
    const placesList = document.getElementById("places");

    for (let i = 0, place; (place = places[i]); i++) {
      const li = document.createElement("li");
      li.textContent = place.name;
      placesList.appendChild(li);
      bounds.extend(place.geometry.location);
    }
  }
</script>
@endsection
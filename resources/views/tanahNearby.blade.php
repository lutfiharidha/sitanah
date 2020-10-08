@extends('layouts.app')
@section('content')
<div class="uk-child-width-1-2@m uk-margin-bottom" uk-grid>
    <div class="uk-width-1-5@m" >
        <form action="/tanah/terdekat/{{ $latitude }}/{{ $longitude }}" method="get">
            <h3>Filter</h3>
            <hr style="border:0.4px solid black">
            <div class="uk-margin">
                <select class="uk-select" name="radius" id="">
                    <option>- Radius -</option>
                    <option value="1" @if($r == 1) selected @endif>1 Km</option>
                    <option value="2" @if($r == 2) selected @endif>2 Km</option>
                    <option value="3" @if($r == 3) selected @endif>3 Km</option>
                    <option value="4" @if($r == 4) selected @endif>4 Km</option>
                    <option value="5" @if($r == 5) selected @endif>5 Km</option>
                </select>
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="jenis" id="">
                    <option value="">- status -</option>
                    <option value="jual" @if($jenis == 'jual') selected @endif>Dijual</option>
                    <option value="sewa" @if($jenis == 'sewa') selected @endif>Disewa</option>
                </select>
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="harga" id="">
                    <option value="">- Harga -</option>
                    <option value="0-100000000" @if($harga == '0, 100000000') selected @endif>0 - 100,000,000</option>
                    <option value="10000000-200000000" @if($harga == '100000001, 200000000') selected @endif>100,000,001 - 200,000,000</option>
                    <option value="200000001-300000000" @if($harga == '200000001, 300000000') selected @endif>200,000,001 - 300,000,000</option>
                    <option value=">-300000001" @if($harga == '>, 300000001') selected @endif>> 300,000,001</option>
                </select>
            </div>
            <div class="uk-margin">
                <button class="uk-button uk-button-primary uk-border-rounded" id="textInput" type="submit">Filter</button>
            </div>
        </form>
    </div>
    <div class="uk-width-expand@m uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
        @foreach ($arr as $tanah)
        <div>
            <div class="uk-card uk-card-default uk-border-rounded uk-inline">
                <div class="uk-card-media-top uk-margin-remove-bottom">
                    <img class="near" src="{{ url('img/tanah', $tanah['foto']) }}" alt=""><br><br>
                    <div class="uk-position-top-left uk-position-small uk-text-bold" style="color: #000"><span uk-icon="icon:location"></span>{{ $tanah['distance'] }}</div>
                </div>
                <div class="uk-card-body uk-margin-left" style="padding: 0;">
                    <h4>{{ str_limit($tanah['title'], $limit = 20, $end = '...') }}</h4>
                    <p>
                    Di <span class="uk-text-bold uk-text-capitalize">{{ $tanah['jenis'] }}</span><br>
                    Luas <span class="uk-text-bold uk-text-lowercase">{{ $tanah['luas'] }} m<sup>2</sup></span><br>
                    Harga <span class="uk-text-bold">{{ number_format($tanah['harga']) }}</span></p>
                </div>
                <div class="uk-card-footer">
                    <a class="uk-width-1 uk-button uk-button-default uk-align-center" href="{{ route('tanahShow', $tanah['slug']) }}">Lihat Info</a>
    
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
@section('script')
<script>
 document.registrationForm.hargaId.oninput = function(){
    document.registrationForm.hargaOutput.value = document.registrationForm.hargaId.value;
 }
</script>
@endsection
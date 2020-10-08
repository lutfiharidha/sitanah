@extends('layouts.app')
@section('content')
<div>
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('beranda') }}">Halaman Utama</a></li>
    </ul>
</div>
<div class="uk-child-width-1-2@m uk-margin-bottom" uk-grid>
    <div class="uk-width-1-5@m">
        <form action="{{ Request::url() }}" method="get">
            <h3>Filter</h3>
            <hr style="border:0.4px solid black">
            <div class="uk-margin">
                <select class="uk-select" name="jenis" id="">
                    <option value="">- Jenis -</option>
                    <option value="jual" @if($jenis == 'jual') selected @endif>Dijual</option>
                    <option value="sewa" @if($jenis == 'sewa') selected @endif>Disewa</option>
                </select>
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="harga" id="">
                    <option value="">- Harga -</option>
                    <option value="0-100000000" @if($harga == '0-100000000') selected @endif>0 - 100,000,000</option>
                    <option value="100000001-200000000" @if($harga == '100000001-200000000') selected @endif>100,000,001 - 200,000,000</option>
                    <option value="200000001-300000000" @if($harga == '200000001-300000000') selected @endif>200,000,001 - 300,000,000</option>
                </select>
            </div>
            <div class="uk-margin">
                <button class="uk-button uk-button-primary uk-border-rounded" id="textInput" type="submit">Filter</button>
            </div>
        </form>
    </div>
    <div class="uk-width-expand@m uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
        @if(count($tanah) == 0)
            <div class="uk-align-center uk-border-rounded uk-card uk-card-default uk-card-body uk-width-1-2@m">
                <img src="https://vinoroc.com/static/app/images/no-record-found.76d6bd93c23b.gif" alt="">
                <h2 class="uk-text-center uk-margin-remove-top">Opsss, Tidak Ada Data Tanah yang Terjual atau Disewakan</h2>
            </div>
        @else
                @foreach ($tanah as $tan)
                    <div>
                        <div class="uk-card uk-card-default uk-border-rounded uk-inline">
                            <div class="uk-card-media-top uk-margin-remove-bottom">
                                <img class="near" src="{{ url('img/tanah', $tan->tanah_has_foto[0]->foto) }}" alt=""><br><br>
                            </div>
                            <div class="uk-card-body uk-margin-left" style="padding: 0;">
                                <h4>{{ str_limit($tan->title, $limit = 20, $end = '...') }}</h4>
                                <p>
                                Di <span class="uk-text-bold uk-text-capitalize">{{ $tan->jenis }}</span><br>
                                Luas <span class="uk-text-bold uk-text-lowercase">{{ $tan->luas }} m<sup>2</sup></span><br>
                                Harga <span class="uk-text-bold">{{ number_format($tan->harga) }}</span></p>
                            </div>
                            <div class="uk-card-footer">
                                <a class="uk-width-1 uk-button uk-button-default uk-align-center" href="{{ route('tanahShow', $tan->slug) }}">Lihat Info</a>

                            </div>
                        </div>
                    </div>
                @endforeach
        @endif
    </div>
</div>
@endsection
@section('script')

@endsection
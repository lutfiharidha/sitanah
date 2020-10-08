@extends('layouts.appAuth')
@section('content')
<form action="{{route('updateTanah', $tanah) }}" class="uk-form-horizontal uk-margin-large" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}
    <div class="uk-width-xlarge">
        <h4>Tambahkan detil informasi</h4>
        <p class="uk-text-muted">Silahkan tambah detail informasi seperti harga, luas tanah dll. Lebih akurat informasi yang diberikan – lebih banyak lead</p>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Title</label>
        <div class="uk-form-controls">
            <input name="title" class="uk-input" id="form-stacked-text" type="text" value="{{$tanah->title}}">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Harga</label>
        <div class="uk-form-controls">
            <input  name="harga" class="uk-input" id="rupiah" type="text" value="{{$tanah->harga}}">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Luas (m<sup>2</sup>)</label>
        <div class="uk-form-controls">
            <input name="luas" class="uk-input" id="form-stacked-text" type="text" value="{{$tanah->luas}}">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Jenis</label>
        <div class="uk-form-controls">
            <select name="jenis" class="uk-select">
                <option value="jual" @if($tanah->jenis == 'jual') checked @endif>Jual</option>
                <option value="sewa" @if($tanah->jenis == 'sewa') checked @endif>Sewa</option>
            </select>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Sertifikat</label>
        <div class="uk-form-controls">
            <select name="sertifikat" class="uk-select" required>
                <option value="HGB" @if($tanah->jenis == 'HGB') checked @endif>HGB - Hak Guna Bangun</option>
                <option value="SHM" @if($tanah->jenis == 'SHM') checked @endif>SHM - Sertifikat Hak Milik</option>
                <option value="Lainnya" @if($tanah->jenis == 'Lainnya') checked @endif>Lainnya(PPJB, Girik, Adat, Dll)</option>
            </select>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Description</label>
        <div class="uk-form-controls">
            <textarea name="description" class="uk-textarea" rows="7">{{$tanah->description}}</textarea>
        </div>
    </div>
    <div class="uk-margin-large-top uk-width-xlarge">
        <h4>Unggah foto tanah</h4>
        <p class="uk-text-muted">
            Pencari proyek akan mengabaikan proyek tanpa foto. Buatlah proyek Anda lebih menarik dengan mengunggah foto atau, bahkan video!
        </p>
    </div>
    <label class="uk-form-label uk-text-bold" for="form-stacked-text">Foto <button class="uk-button uk-button-primary uk-button-small uk-border-rounded" id="add" type="button">+ Foto</button></label>
    <div id="formImage" class="uk-margin">
        @foreach ($fotoTanah as $foto)
        <div class="uk-form-controls uk-margin-small">
            <div uk-form-custom="target: true">
                <img class="tanahFoto" src="{{url("img/tanah/",$foto->foto)}}" alt="" srcset="">
                <input name="fotoTanah_{{$foto->id}}" type="file">
                <input class="uk-input uk-form-width-medium" type="text" value="Select file" disabled>
                <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
            </div>
            <input name="deleteFoto_{{$foto->id}}" class="uk-checkbox" type="checkbox" value="delete"> <span class="uk-text-bold uk-text-danger">Delete</span></label>
        </div>
        @endforeach
    </div>
    <div class="uk-margin-large-top uk-width-xlarge">
        <h4>Dimana lokasi properti Anda?</h4>
        <p class="uk-text-muted">
            Untuk pencari rumah, lokasi adalah segalanya! Berikan informasi lokasi selengkapnya, agar para pencari properti dapat dengan mudah menemukan properti Anda.
        </p>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Alamat</label>
        <div class="uk-form-controls">
            <input name="alamat" class="uk-input" id="form-stacked-text" type="text" value="{{$tanah->alamat}}">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Kecamatan</label>
            <div class="uk-form-controls">
                <select style="width:360px" name="kecamatan" id='kecamatan' required>
                    <option value="">Pilih Kecamatan</option>
                    <option value="Lhokseumawe, Banda Sakti">Lhokseumawe, Banda Sakti</option>
                    <option value="Lhokseumawe, Blang Mangat">Lhokseumawe, Blang Mangat</option>
                    <option value="Lhokseumawe, Muara Dua">Lhokseumawe, Muara Dua</option>
                    <option value="Lhokseumawe, Muara Satu">Lhokseumawe, Muara Satu</option>
                    <option value="Aceh Utara, Baktiya">Aceh Utara, Baktiya</option>
                    <option value="Aceh Utara, Baktiya Barat">Aceh Utara, Baktiya Barat</option>
                    <option value="Aceh Utara, Banda Baro">Aceh Utara, Banda Baro</option>
                    <option value="Aceh Utara, Cot Girek">Aceh Utara, Cot Girek</option>
                    <option value="Aceh Utara, Dewantara">Aceh Utara, Dewantara</option>
                    <option value="Aceh Utara, Geuredong Pase">Aceh Utara, Geuredong Pase</option>
                    <option value="Aceh Utara, Kuta Makmur">Aceh Utara, Kuta Makmur</option>
                    <option value="Aceh Utara, Langkahan">Aceh Utara, Langkahan</option>
                    <option value="Aceh Utara, Lapang">Aceh Utara, Lapang</option>
                    <option value="Aceh Utara, Lhoksukon">Aceh Utara, Lhoksukon</option>
                    <option value="Aceh Utara, Matangkuli">Aceh Utara, Matangkuli</option>
                    <option value="Aceh Utara, Meurah Mulia">Aceh Utara, Meurah Mulia</option>
                    <option value="Aceh Utara, Muara Batu">Aceh Utara, Muara Batu</option>
                    <option value="Aceh Utara, Nibong">Aceh Utara, Nibong</option>
                    <option value="Aceh Utara, Nisam">Aceh Utara, Nisam</option>
                    <option value="Aceh Utara, Nisam Antara">Aceh Utara, Nisam Antara</option>
                    <option value="Aceh Utara, Paya Bakong">Aceh Utara, Paya Bakong</option>
                    <option value="Aceh Utara, Pirak Timur">Aceh Utara, Pirak Timur</option>
                    <option value="Aceh Utara, Samudera">Aceh Utara, Samudera</option>
                    <option value="Aceh Utara, Sawang">Aceh Utara, Sawang</option>
                    <option value="Aceh Utara, Seunuddon (Seunudon)">Aceh Utara, Seunuddon (Seunudon)</option>
                    <option value="Aceh Utara, Simpang Kramat (Keramat)">Aceh Utara, Kramat (Keramat)</option>
                    <option value="Aceh Utara, Syamtalira Aron">Aceh Utara, Syamtalira Aron</option>
                    <option value="Aceh Utara, Syamtalira Bayu">Aceh Utara, Syamtalira Bayu</option>
                    <option value="Aceh Utara, Tanah Jambo Aye">Aceh Utara, Tanah Jambo Aye</option>
                    <option value="Aceh Utara, Tanah Luas">Aceh Utara, Tanah Luas</option>
                    <option value="Aceh Utara, Tanah Pasir">Aceh Utara, Tanah Pasir</option>
                </select>
            </div>
        </div>
    <div class="uk-margin-large-top uk-margin-large-top uk-width-xlarge">
        <h4>Mohon tinjau kembali kontak detil Anda</h4>
        <p class="uk-text-muted">
            Pastikan detil Anda terupdate dengan baik sehingga para pencari property dapat dengan mudah menghubungi Anda di jalur yang tepat.
        </p>
    </div>
    
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Nama Lengkap</label>
        <div class="uk-form-controls">
            <input name="nama" class="uk-input" id="form-stacked-text" type="text" value="{{$penjual->penjual_has_user->name}}" value="Masukan nama jalan, gang dll">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Email</label>
        <div class="uk-form-controls">
            <input name="email" class="uk-input" id="form-stacked-text" type="email" value="{{$penjual->penjual_has_user->email}}" value="someone@mail.com">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label uk-text-bold" for="form-stacked-text">Handphone</label>
        <div class="uk-form-controls">
            <input name="noHp" class="uk-input" id="form-stacked-text" type="text" value="{{$penjual->no_telp}}" value="08xxxxxxxxxx">
        </div>
    </div>
    <div class="uk-margin-medium-top">
        <div class="uk-align-right">
            <input class="uk-button uk-button-primary" id="form-stacked-text" type="submit" value="Publikasi tanah Anda">
        </div>
    </div>
</form>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#kecamatan').select2();
        });
                var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
		}
        $(document).ready(function() {
            var max_fields      = 5; //maximum input boxes allowed
            var wrapper   		= $("#formImage"); //Fields wrapper
            var add_button      = $("#add"); //Add button ID
            
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="uk-form-controls uk-margin-small">\
                    <div uk-form-custom="target: true">\
                        <input name="fotoTanah[]" type="file">\
                        <input class="uk-input uk-form-width-medium" type="text" value="Select file" disabled>\
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>\
                    </div>\
                    <button class="uk-button uk-button-danger uk-button-small uk-border-rounded" id="remove_field" type="button">- Delete</button>\
                </div>'); //add input box
                }
            });
            
            $(wrapper).on("click","#remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>
@endsection

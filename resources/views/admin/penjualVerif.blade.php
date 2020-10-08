@extends('layouts.appAuth')
@section('content')
    <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telpon</th>
                <th>KTP</th>
                <th>Daftar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allPenjual as $key => $user)
                @foreach ($user->user_has_penjual as $key => $penjual)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$penjual->no_telp}}</td>
                    <td><a class="uk-button uk-button-text uk-text-primary" href="#modal-center-{{$user->id}}" uk-toggle>{{$penjual->ktp}}</a></td>
                    <div id="modal-center-{{$user->id}}" class="uk-flex-top" uk-modal>
                        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-text-capitalize uk-border-rounded">
                            <button class="uk-modal-close-default" type="button" uk-close></button>
                            <img class="foto-ktp" src="{{url('img/ktp',$penjual->foto_ktp)}}" alt="">
                            <p class="uk-padding-small"><span class="uk-text-bold">No KTP:</span> {{$penjual->ktp}}<br>
                            <span class="uk-text-bold">Nama Lengkap:</span> {{$user->name}}<br>
                            <span class="uk-text-bold">Alamat:</span> {{$penjual->alamat}}<br>
                            <span class="uk-text-bold">Kecamatan:</span> {{$penjual->kecamatan}}<br>
                            <span class="uk-text-bold">Kota:</span> {{$penjual->kota}}</p>
                        </div>
                    </div>
                    <td>{{ $penjual->created_at->format('d-m-Y') }}</td>
                    <td><a class="uk-button uk-button-text uk-text-warning" href="#modal-banned-{{$user->id}}" uk-toggle>Banned</a><br>
                        <div id="modal-banned-{{$user->id}}" class="uk-flex-top" uk-modal>
                            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-text-capitalize uk-border-rounded">
                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                <form action="{{ route('statusPenjual', $user) }}" method="post">
                                    @csrf
                                        {{ method_field('PUT') }}
                                    <label for="">MESSAGE</label>
                                    <textarea name="message" class="uk-textarea" id="" cols="30" rows="10"></textarea>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                        <input class="uk-button uk-button-text uk-text-warning" type="submit" onclick="alert('Are you sure to banned {{$user->name}}?')" value="BANNED">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <form class="uk-button uk-button-text " action="{{ route('deleteTanah', $user) }}" method="post">
                            @csrf
                                {{ method_field('DELETE') }}
                                <input class="uk-button uk-button-text uk-text-danger" type="submit" onclick="alert('Are you sure to delete {{$user->name}}?')" value="DELETE">
                            </form>
                    </td>
                </tr>
            @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telpon</th>
                <th>KTP</th>
                <th>Daftar</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
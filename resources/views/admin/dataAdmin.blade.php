@extends('layouts.appAuth')
@section('content')
<a class="uk-button uk-button-primary uk-margin-bottom" href="{{ route('addAdmin') }}"> Add Admin</a>
<table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Join In</th>
        </tr>
    </thead>
    <tbody>
        @foreach($admins as $admin)
        <tr>
            <td class="uk-text-capitalize">{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>{{$admin->created_at->format('F-Y')}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Join In</th>
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
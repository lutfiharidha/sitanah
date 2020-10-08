@extends('layouts.appAuth')
@section('content')
<h2>Update Profile</h2>
<form class="uk-padding-small" action="{{ route('penjualupdateProfile') }}" method="post">
@csrf
@method('PUT')
<div class="uk-margin">
    <label class="uk-form-label" for="form-stacked-text">Nama</label>
    <div class="uk-form-controls">
        <input name="name" class="uk-input" id="form-stacked-text" type="text" value="{{ $profile->name }}">
    </div>
</div>

<div class="uk-margin">
    <label class="uk-form-label" for="form-stacked-text">Email</label>
    <div class="uk-form-controls">
        <input name="email" class="uk-input" id="form-stacked-text" type="email" value="{{ $profile->email }}">
    </div>
</div>
<div class="uk-margin">
    <label class="uk-form-label" for="form-stacked-text">Password</label>
    <div class="uk-form-controls">
        <input name="password" class="uk-input" id="form-stacked-text" type="password" placeholder="New Password">
    </div>
</div>
<div class="uk-margin">
    <label class="uk-form-label" for="form-stacked-text">Confirm Password</label>
    <div class="uk-form-controls">
        <input name="password_confirmation" class="uk-input" id="form-stacked-text" type="password" placeholder="Ketik password ulang">
    </div>
</div>
<div class="uk-margin">
    <div class="uk-form-controls">
        <input class="uk-align-right uk-button uk-button-primary" id="form-stacked-text" type="submit" value="Update">
    </div>
</div>
</form>
@endsection

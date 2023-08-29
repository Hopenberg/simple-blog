@extends('master')

@section('content')
<form method="POST" action="/store-new-password">
    @csrf
    <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter email">
    </div>
    <div class="form-group mt-3">
        <label for="passwordInput">Password</label>
        <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password">
    </div>
    <div class="form-group mt-3">
        <label for="passwordRepeatInput">Password repeat</label>
        <input type="password" class="form-control" id="passwordRepeatInput" name="password_confirmation"
            placeholder="Repeat password">
    </div>
    <input type="hidden" name="token" value="{{$token}}">

    <button type="submit" class="btn btn-primary mt-3">Reset</button>
</form>

@if ($errors->any())
<div class="alert alert-danger mt-3">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection
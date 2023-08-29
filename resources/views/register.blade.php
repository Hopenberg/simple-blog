@extends('master')

@section('content')
<form action="/register" method="POST">
    @csrf
    <div class="form-group">
        <label for="nameInput">Full name</label>
        <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter email"
            value="{{ old('name') }}">
    </div>
    <div class="form-group mt-3">
        <label for="emailInput">Email address</label>
        <input type="email" class="form-control" id="emailInput" name="email" value="{{ old('email') }}"
            placeholder="Enter email">
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
    <div class="form-check mt-3">
        <input type="checkbox" class="form-check-input" id="rememberInput" name="remember_me">
        <label class="form-check-label" for="rememberInput">Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Sign in</button>
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
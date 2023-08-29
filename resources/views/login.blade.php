@extends('master')

@section('content')
<form method="POST" action="/login">
    @csrf
    <div class="form-group">
        <label for="emailInput">Email address</label>
        <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter email">
    </div>
    <div class="form-group mt-3">
        <label for="passwordInput">Password</label>
        <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password">
        <a href="/password-reset">I forgot my password</a>
    </div>
    <div class="form-check mt-3">
        <input type="checkbox" class="form-check-input" id="rememberMeInput" name="remember_me">
        <label class="form-check-label" for="rememberMeInput">Remember me</label>
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
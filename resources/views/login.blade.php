@extends('master')

@section('content')
<form method="POST" action="/login">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email"
            placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with
            anyone else.</small>
    </div>
    <div class="form-group mt-3">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" aria-describedby="passwordHelp"
            placeholder="Password" name="password">
        <a href="/password-reset">I forgot my password</a>
    </div>
    <div class="form-check mt-3">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember me</label>
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

@extends('master')

@section('content')
<form method="POST" action="/password-reset">
    @csrf
    <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input type="email" class="form-control" id="inputEmail" name="email"
            placeholder="Enter email">
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Send link</button>
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

@extends('master')

@section('content')
<div class="row row-cols-12 g-3">
    <div class="col">
        <h3>Password change for: {{ $user->name }} ({{ $user->email }})</h3>
        <form action="/admin-panel/users/update-password/{{ $user->id }}" method="post">
            @csrf
            <div class="form-group mt-3">
                <label for="passwordInput">Password</label>
                <input name="password" type="password" class="form-control" id="passwordInput" placeholder="Password">
            </div>
            <div class="form-group mt-3">
                <label for="passwordConfirmationInput">Password confirmation</label>
                <input name="password_confirmation" type="password" class="form-control" id="passwordConfirmationInput"
                    placeholder="Password confirmation">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
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
    </div>
</div>
@endsection
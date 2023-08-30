@extends('master')

@section('content')
<div class="row row-cols-12 g-3">
    <div class="col">
        @if (!empty($user->id))
        <form action="/admin-panel/users/update/{{ $user->id }}" method="post">
            @else
            <form action="/admin-panel/users/store" method="post">
                @endif
                @csrf
                <div class="form-group">
                    <label for="nameInput">Name</label>
                    <input name="name" type="text" class="form-control" id="nameInput" placeholder="Name"
                        value="{{ old('name', $user->name) }}">
                </div>
                @if (empty($user->id))
                <div class="form-group mt-3">
                    <label for="emailInput">Email address</label>
                    <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter email"
                        value="{{ old('email', $user->email) }}">
                </div>
                <div class="form-group mt-3">
                    <label for="passwordInput">Password</label>
                    <input name="password" type="password" class="form-control" id="passwordInput"
                        placeholder="Password">
                </div>
                <div class="form-group mt-3">
                    <label for="passwordConfirmationInput">Password confirmation</label>
                    <input name="password_confirmation" type="password" class="form-control"
                        id="passwordConfirmationInput" placeholder="Password confirmation">
                </div>
                @endif

                <button type="submit" class="btn btn-primary mt-3">@if (!empty($user->id)) Update @else
                    Create @endif</button>
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
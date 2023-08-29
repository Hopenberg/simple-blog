@extends('master')

@section('content')
<div class="row row-cols-12 g-3">
    <div class="col">
        <form action="/admin-panel/users/update-roles/{{ $user->id }}" method="post">

            @csrf
            <select class="form-select" name="roles[]" multiple>
                @foreach ($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>

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
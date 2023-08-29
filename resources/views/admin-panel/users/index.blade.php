@extends('master')

@section('content')
@can('user-add')
<a class="btn btn-primary" href="/admin-panel/users/create">Create</a>
@endcan
<div class="row row-cols-md-12 g-3 mt-3">
    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td> {{ $user->name }}</td>
                    <td> {{ $user->email }} </td>
                    <td>
                        @can('user-edit')
                        <a class="btn btn-primary" href="/admin-panel/users/edit/{{ $user->id }}">Edit</a>
                        <a class="btn btn-primary" href="/admin-panel/users/edit-password/{{ $user->id }}">Edit
                            password</a>
                        @endcan
                        @can('user-grant-permission')
                        <a class="btn btn-primary" href="/admin-panel/users/edit-roles/{{ $user->id }}">Edit roles</a>
                        @endcan
                        @can('user-delete')
                        <form action="{{ route('admin-panel.users.destroy', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block mt-1">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection
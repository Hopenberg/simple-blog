@extends('master')

@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <div class="col">
        @can('post-listing')
        <a class="btn btn-primary" href="/admin-panel/posts" role="button">Posts</a>
        @endcan
        @can('user-listing')
        <a class="btn btn-primary" href="/admin-panel/users" role="button">Users</a>
        @endcan
    </div>
</div>
@endsection
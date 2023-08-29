@extends('master')

@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach ($posts as $post)
    <div class="col">
        <div class="card shadow-sm">
            <img height="250px" src="{{asset($post->cover)}}" alt="Post cover" onerror="this.onerror=null; this.src='{{asset('default.jpg')}}'"/>
            <div class="card-body">
                <p class="card-text">{{ $post->title }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a role="button" href="/posts/{{ $post->id }}" class="btn btn-sm btn-outline-secondary">View</a>
                        @can('post-edit')
                        <a role="button" class="btn btn-sm btn-outline-secondary"
                            href="/admin-panel/posts/edit/{{ $post->id }}">Edit</a>
                        @endcan
                    </div>
                    <small class="text-body-secondary">9 mins</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach



</div>
{{ $posts->links() }}
@endsection
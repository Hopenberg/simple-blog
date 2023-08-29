@extends('master')

@section('content')
@can('post-add')
<a class="btn btn-primary" href="/admin-panel/posts/create">Create</a>
@endcan
<div class="row row-cols-md-12 g-3 mt-3">
    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td> {{ $post->title }}</td>
                    <td> {{ Str::limit($post->content, 150, $end='...') }} </td>
                    <td>
                        @can('post-edit')
                        <a class="btn btn-primary" href="/admin-panel/posts/edit/{{ $post->id }}">Edit</a>
                        @endcan
                        @can('post-delete')
                        <form action="{{ route('admin-panel.posts.destroy', ['id' => $post->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block mt-1">Delete</button>
                        </form>    
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
</div>
@endsection
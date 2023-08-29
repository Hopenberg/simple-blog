@extends('master')

@section('content')
<div class="row row-cols-12 g-3">
    <div class="col">
        @if (!empty($post->id))
        <form action="/admin-panel/posts/update/{{ $post->id }}" enctype="multipart/form-data" method="post">
            @else
            <form action="/admin-panel/posts/store" enctype="multipart/form-data" method="post">
                @endif
                @csrf
                <div class="mb-3">
                    <label for="fileInput" class="form-label">Post cover</label>
                    <input name="cover" class="form-control" type="file" id="fileInput">
                  </div>
                <div class="form-group">
                    <label for="titleInput">Title</label>
                    <input name="title" type="text" class="form-control" id="titleInput" placeholder="Title"
                        value="{{ old('title', $post->title) }}">
                </div>
                <div class="form-group mt-3">
                    <label for="contentInput">Content</label>
                    <textarea name="content" class="form-control" id="contentInput" cols="30"
                        rows="10">{{ old('content', $post->content) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">@if (!empty($post->id)) Update @else
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
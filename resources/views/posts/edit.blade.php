@extends('layouts.master')

@section('content')
    <h1>Form cập nhật: {{ $post->title }}</h1>

    @if(\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="post">
        @csrf
        @method('PUT')

        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">

        <label for="describe" class="mt-3">Describe</label>
        <textarea name="describe" id="describe" cols="30" rows="10" class="form-control">{{ $post->describe }}</textarea>

        <label for="status" class="mt-3">Status</label>

        <input type="radio" name="status" id="status-1"

               @if($post->status == \App\Models\Post::STATUS_DRAFT) checked @endif

               value="{{ \App\Models\Post::STATUS_DRAFT }}">

        <label for="status-1">{{ \App\Models\Post::STATUS_DRAFT }}</label>

        <input type="radio" name="status" id="status-2"

               @if($post->status == \App\Models\Post::STATUS_PUBLISHED) checked @endif

               value="{{ \App\Models\Post::STATUS_PUBLISHED }}">

        <label for="status-2">{{ \App\Models\Post::STATUS_PUBLISHED }}</label>

        <br>
        <br>
        <a href="{{ route('posts.index') }}" class="btn btn-warning">Quay lại danh sách</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

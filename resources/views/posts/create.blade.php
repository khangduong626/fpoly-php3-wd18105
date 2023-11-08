@extends('layouts.master')

@section('content')
    <h1>Form thêm mới</h1>

    @if(\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control">

        <label for="img">Img</label>
        <input type="file" name="img" id="img" class="form-control">

        <label for="describe" class="mt-3">Describe</label>
        <textarea name="describe" id="describe" cols="30" rows="10" class="form-control"></textarea>

        <label for="status" class="mt-3">Status</label>

        <input type="radio" name="status" id="status-1" value="{{ \App\Models\Post::STATUS_DRAFT }}">
        <label for="status-1">{{ \App\Models\Post::STATUS_DRAFT }}</label>

        <input type="radio" name="status" id="status-2" value="{{ \App\Models\Post::STATUS_PUBLISHED }}">
        <label for="status-2">{{ \App\Models\Post::STATUS_PUBLISHED }}</label>

        <br>
        <br>
        <a href="{{ route('posts.index') }}" class="btn btn-warning">Quay lại danh sách</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

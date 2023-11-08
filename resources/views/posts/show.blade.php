@extends('layouts.master')

@section('content')
    <h1>Xem chi tiết: {{ $post->title }}</h1>

    <ul>
        <li>Title: {{ $post->title }}</li>
        <li>Img: <img src="{{ \Storage::url($post->img) }}" alt="" width="100px"></li>
        <li>Describe: {{ $post->describe }}</li>
        <li>Status: {{ $post->status }}</li>
    </ul>

    <a href="{{ route('posts.index') }}" class="btn btn-warning mt-3">Quay lại danh sách</a>
@endsection

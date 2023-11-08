@extends('layouts.master')

@section('content')
    <h1>Danh sách bài viết</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-info">Thêm mới</a>

    @if(\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Image</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>
                    <img src="{{ \Storage::url($item->img) }}" alt="" width="100px">
                </td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="{{ route('posts.show', $item) }}" class="btn btn-warning">Show</a>
                    <a href="{{ route('posts.edit', $item) }}" class="btn btn-info">Edit</a>

                    <form action="{{ route('posts.destroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Có chắc chắn xóa không?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
@endsection

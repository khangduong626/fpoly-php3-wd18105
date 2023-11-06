@extends('layouts.master')

@section('content')
    <h1>Danh sách bài viết</h1>

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
                    <img src="{{ asset($item->img) }}" alt="" width="100px">
                </td>
                <td>{{ $item->status }}</td>
                <td>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
@endsection

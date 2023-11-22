@extends('layouts.master')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Car</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Car
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline mb-4">
                            <div class="card-header" style="display:flex; justify-content: space-around">
                                <div class="card-title">Danh sách</div>
                                <a href="{{ route('admin.cars.create') }}" class="btn btn-info">Thêm mới</a>
                            </div>

                            <div class="card-body">
                                @if(\Session::has('msg'))
                                    <div class="alert alert-success">
                                        {{ \Session::get('msg') }}
                                    </div>
                                @endif

                                <table class="table">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Img Thumbnail</th>
                                        <th>Brand</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <img src="{{ \Storage::url($item->img_thumbnail) }}" alt=""
                                                     width="100px">
                                            </td>
                                            <td>
                                                {{ $item->brand->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.cars.edit', $item) }}" class="btn btn-primary">Sửa</a>

                                                <form action="{{ route('admin.cars.destroy', $item) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            onclick="return confirm('OK CHƯA?')"
                                                            class="btn btn-danger">Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>

                                {{ $data->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

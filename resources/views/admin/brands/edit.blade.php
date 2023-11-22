@extends('layouts.master')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Brand</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Brand
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
                            <div class="card-header">
                                <div class="card-title">Sửa: {{ $brand->name }}</div>
                            </div>

                            <div class="card-body">
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

                                <form action="{{ route('admin.brands.update', $brand) }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $brand->name }}">

                                    <label for="img">Img</label>
                                    <input type="file" name="img" id="img" class="form-control">
                                    <img src="{{ \Storage::url($brand->img) }}" alt="" width="100px">

                                    <br>
                                    <label for="is_show">Is Show</label>
                                    <select name="is_show" id="is_show" class="form-control">
                                        <option @if($brand->is_show) selected @endif value="1">Show</option>
                                        <option @if(!$brand->is_show) selected @endif value="0">Hide</option>
                                    </select>

                                    <br>

                                    <a href="{{ route('admin.brands.index') }}" class="btn btn-primary">Về trang list</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
